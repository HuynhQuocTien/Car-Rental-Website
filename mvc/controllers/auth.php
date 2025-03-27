<?php

class Auth extends Controller
{

    public $userModel;
    public $accountModel;
    public $customerModel;
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
        $this->userModel = $this->model("UserModel");
        $this->accountModel = $this->model("AccountModel");
        $this->customerModel = $this->model("CustomerModel");
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

    
}
?>