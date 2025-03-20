<?php

class Auth extends Controller
{

    public $userModel;
    public $googleAuth;
    public $mailAuth;
    function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }
    function __construct()
    {
        
    }
    function signin()
    {
        $url = $this->UrlProcess();
        if (in_array($url[0], ['admin'])) {
            $this->view("single_layout", [
                "Page" => "auth/signin",
                "Title" => "Đăng nhập Admin",
            ],
            "admin");
        } else  if (in_array($url[0], ['user'])) {
            $this->view("single_layout", [
                "Page" => "auth/signin",
                "Title" => "Đăng nhập",
            ],
            "user");
        } else {
            header("Location: ./auth/signin");
        }
    }


    function signup()
    {
        $url = $this->UrlProcess();
        if (in_array($url[0], ['user'])){
        $this->view("single_layout", [
            "Page" => "auth/signup",
            "Title" => "Đăng ký tài khoản"
        ],
        "user");
        }
    }

    function forgot()
    {
        $url = $this->UrlProcess();
        if (in_array($url[0], ['user'])){
        $this->view("single_layout", [
            "Page" => "auth/forgot",
            "Title" => "Khôi phục tài khoản",
        ],
        "user");
        } else if(in_array($url[0], ['admin'])){
            $this->view("single_layout", [
                "Page" => "auth/forgot",
                "Title" => "Khôi phục tài khoản",
            ],
            "admin");
        }
    }

    function otp()
    {
        $url = $this->UrlProcess();
        if (in_array($url[0], ['admin'])) {
            $this->view("single_layout", [
                "Page" => "auth/otp",
                "Title" => "Nhập mã OTP",
            ],
            "admin");
        } else if (in_array($url[0], ['user'])) {
            $this->view("single_layout", [
                "Page" => "auth/otp",
                "Title" => "Nhập mã OTP",
            ],
            "user");
        }
        // if (isset($_SESSION['checkMail'])) {
        //     $this->view("single_layout", [
        //         "Page" => "auth/otp",
        //         "Title" => "Nhập mã OTP",
        //     ],
        //     "user");
        // } else {
        //     header("Location: ./forgot");
        // }
    }

    function resetpass()
    {
        $url = $this->UrlProcess();
        if (in_array($url[0], ['admin'])) {
            $this->view("single_layout", [
                "Page" => "auth/resetpass",
                "Title" => "Nhập mật khẩu mới"
            ],
            "admin");
        } else if (in_array($url[0], ['user'])) {
            $this->view("single_layout", [
                    "Page" => "auth/resetpass",
                    "Title" => "Nhập mật khẩu mới"
                ],
                "user");
        }
        // if (isset($_SESSION['checkMail'])) {
        //     $this->view("single_layout", [
        //         "Page" => "auth/resetpass",
        //         "Title" => "Nhập mật khẩu mới"
        //     ],
        //     "user");
        // } else {
        //     header("Location: ./forgot");
        // }
    }

    public function addUser()
    {
        AuthCore::checkAuthentication();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $this->userModel->create($email, $fullname, $password, "1990-01-01", 1, 1, 1);
            echo $result;
        }
    }

    public function getUser()
    {
        if (isset($_POST['email'])) {
            $user = $this->userModel->getById($_POST['email']);
            echo json_encode($user);
        }
    }

    // public function checkLogin()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $masinhvien = $_POST['masinhvien'];
    //         $password = $_POST['password'];
    //         $result = $this->userModel->checkLogin($masinhvien, $password);
    //         echo $result;
    //     }
    // }
    public function checkLogin()
{
    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Use isset to avoid undefined index notices
        $masinhvien = isset($_POST['masinhvien']) ? $_POST['masinhvien'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Basic validation
        if (empty($masinhvien) || empty($password)) {
            echo json_encode(['error' => 'Username and password are required.']);
            return; // Exit if validation fails
        }

        // Assuming checkLogin returns a boolean or user data
        $result = $this->userModel->checkLogin($masinhvien, $password);

        // Provide a more informative response
        if ($result) {
            echo json_encode(['success' => 'Login successful!', 'data' => $result]);
        } else {
            echo json_encode(['error' => 'Invalid username or password.']);
        }
    } else {
        // Handle other request methods if necessary
        echo json_encode(['error' => 'Invalid request method.']);
    }
}


    public function checkEmail()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mail = $_POST['email'];
            $check = $this->userModel->getByEmail($mail);
            
            echo json_encode($check);
        }
    }

    public function checkOpt()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $opt = $_POST['opt'];
            $email = $_SESSION['checkMail'];
            $check = $this->userModel->checkOpt($email, $opt);
            echo $check;
        }
    }

    public function changePassword(){
        AuthCore::checkAuthentication();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST['password'];
            $email = $_SESSION['checkMail'];
            $check = $this->userModel->changePassword($email, $password);
            $resetOTP = $this->userModel->updateOpt($email,"NULL");
            session_destroy();
            echo $check;
        }
    }

    public function sendOptAuth()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $opt = rand(111111, 999999);
            $email = $_POST['email'];
            $sendOTP = $this->mailAuth->sendOpt($email, $opt);
            $resultOTP = $this->userModel->updateOpt($email, $opt);
                $_SESSION['checkMail'] = $email;
            
            echo $resultOTP;
        }
    }

    public function logout()
    {
        AuthCore::checkAuthentication();
        $email = $_SESSION['user_email'];
        $result = $this->userModel->updateToken($email, NULL);
        if ($result) {
            session_destroy();
            setcookie("token", "", time() - 10, '/');
            header("Location: ../auth/signin");
        }
    }
}
?>