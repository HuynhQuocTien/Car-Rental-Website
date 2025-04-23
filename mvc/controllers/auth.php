<?php

class Auth extends Controller
{

    public $userModel;
    public $accountModel;
    public $customerModel;
    public $googleModel;
    public $mailModel;
    public $url;
    function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }
    function __construct()
    {
        $this->userModel = $this->model("UserModel");
        $this->accountModel = $this->model("AccountModel");
        $this->customerModel = $this->model("CustomerModel");
        $this->mailModel = $this->model("MailModel");

        $this->url = $this->UrlProcess(); 
        parent::__construct();
    }

    public function default(){
        $this->view("single_layout", [
            "Page" => "error/404",
            "Title" => "Lỗi !"
        ]);
    }

    public function addCustomer()
    {   
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $phone = $_POST['phone'];
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $check = true;
            $message = "";
            $error_fields = [];
            // Kiểm tra trùng username
            if ($this->accountModel->exists('Username', $username)) {
                $error_fields['username'] = "Username already exists.";
                $check = false;
                $message = "Username already exists.";
            }

            // Kiểm tra trùng email
            if ($this->accountModel->exists('Email', $email)) {
                $error_fields['email'] = "Email already exists.";
                $check = false;
                $message = "Email already exists.";
            }

            // Kiểm tra trùng số điện thoại
            if ($this->customerModel->exists('PhoneNumber', $phone)) {
                $error_fields['phone'] = "Phone number already exists.";
                $check = false;
                $message = "Phone number already exists.";
            }

            // Nếu không có dữ liệu trùng lặp, thêm vào database
            if ($check) {
                $acc = $this->accountModel->create($username, $password, NULL, NULL, NULL, $email, 0);
                $accId = $this->accountModel->getMaxAccountID();
                $result = $this->customerModel->create($fullname, $phone, '1990-01-01', NULL, NULL, NULL, 0, $accId, 0, 0, 0);

                if (!$acc || !$result) {
                    $check = false;
                    $message = "Error creating account.";
                } else {
                    $message = "Account created successfully.";
                }
            }
            echo json_encode(['success' => $check, 'message' => $message,'error_fields' => $error_fields ]);
        }
    }

    public function checkLogin(){
        if (in_array($this->url[0], ['user'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $result = $this->accountModel->checkLogin($username, $password,'user');
                echo $result;
            }
        } else if (in_array($this->url[0], ['admin'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $result = $this->accountModel->checkLogin($username, $password,'admin');
                echo $result;
            }
        }
    }

    public function checkEmail(){
        $check = [];
        if (in_array($this->url[0], ['user', 'admin'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $user = $this->accountModel->getByUsername($email);
                
                if ($user == '') {
                    $check = ["message" => "Email does not exist!", "valid" => false];
                    echo json_encode($check);
                    return;
                }

                if ($this->url[0] == 'user' && $user['RoleID'] != 0) {
                    $check = ["message" => "No permission to access", "valid" => false];
                    echo json_encode($check);
                    return;
                } else if ($this->url[0] == 'admin' && $user['RoleID'] == 0) {
                    $check = ["message" => "No permission to access", "valid" => false];
                    echo json_encode($check);
                    return;
                }
                
                if ($user['Active'] == 0) {
                    $check = ["message" => "Account locked!", "valid" => false];
                    echo json_encode($check);
                    return;
                }
                
                if ($user['Is_Delete'] == 1) {
                    $check = ["message" => "Account has been deleted!", "valid" => false];
                    echo json_encode($check);
                    return;
                }
                
                if ($this->url[0] == 'user' && $user['RoleID'] == 0) {
                    $check = ["message" => "Correct account", "valid" => true];
                    echo json_encode($check);
                    return;
                } elseif ($this->url[0] == 'admin' && $user['RoleID'] != 0) {
                    $check = ["message" => "Correct account", "valid" => true];
                    echo json_encode($check);
                    return;
                }
            }
        }
        echo json_encode($check);
    }

    public function sendOTPAuth()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $otp = rand(111111, 999999);
            $email = $_POST['email'];
            $sendOTP = $this->mailModel->sendOTP($email, $otp);
            $resultOTP = $this->accountModel->updateOTP($email, $otp);
                $_SESSION['checkMail'] = $email;
            
            echo $resultOTP;
        }
    }

    public function checkOTP()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $otp = $_POST['otp'];
            $email = $_SESSION['checkMail'];
            $result = $this->accountModel->checkOTP($email, $otp);
            echo $result;
        }
    }

    public function changePassword(){
        if (in_array($this->url[0], ['user'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $password = $_POST['password'];
                $email = $_SESSION['checkMail'];
                $check = $this->accountModel->changePassword($email, $password);
                $resetOTP = $this->accountModel->updateOTP($email,"NULL");
                session_destroy();
                echo $check;
            }
        } else if (in_array($this->url[0], ['admin'])) {
            AuthCore::onLogin();
            if (isset($_SESSION['checkMail'])) {
                $this->view("single_layout", [
                    "Page" => "auth/changePass",
                    "Title" => "Nhập mật khẩu mới",
                    "Script" => "reset",
                ],
                "admin");
            } else {
                header("Location: ./forgot");
            }
        }
        
    }

    //ADMIN
    public function signin() {
         if (in_array($this->url[0], ['admin'])) {
            AuthCore::onLogin();
            $this->view("single_layout", [
                "Page" => "auth/signin",
                "Script" => "signin",
                "Title" => "Đăng nhập Admin",
            ],
            "admin");
         }
    }
    function forgot()
    {
        AuthCore::onLogin();
        if (in_array($this->url[0], ['admin'])) {
            $this->view("single_layout", [
                "Page" => "auth/forgot",
                "Title" => "Khôi phục tài khoản",
                "Script" => "reset",
            ],
            "admin");
        }
    }

    function otp()
    {
        AuthCore::onLogin();
        if (in_array($this->url[0], ['admin'])) {
            if (isset($_SESSION['checkMail'])) {
                $this->view("single_layout", [
                    "Page" => "auth/otp",
                    "Title" => "Nhập mã OTP",
                    "Script" => "reset",
                ],
                "admin");
            } else {
                header("Location: ./forgot");
            }
        }
    }

    public function logout()
    {
        AuthCore::checkAuthentication();
        $username = $_SESSION['Username'];
        $result = $this->accountModel->updateToken($username, NULL);
        if ($result) {
            session_destroy();
            setcookie("token", "", time() - 10, '/');
            if(isset($_SESSION['RoleID']) && $_SESSION['RoleID'] > 0){
                header("Location: " .BASE_URL."/admin/auth/signin");
            }else if(isset($_SESSION['RoleID']) && $_SESSION['RoleID'] == 0){
                header("Location: " .BASE_URL."/user/home");
            }
        }
    }

}
?>