<?php

class Profile extends Controller {

    public $AccountModel;
    public $CustomerModel;
    public $UserModel;
    public $url;

    // Xử lý URL
    public function UrlProcess() {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }

    // Hàm khởi tạo
    public function __construct() {
        $this->AccountModel = $this->model("AccountModel");
        $this->CustomerModel = $this->model("CustomerModel");
        $this->UserModel = $this->model("UserModel");

        $this->url = $this->UrlProcess(); 
        parent::__construct();
    }

    // Hàm mặc định
    public function default() {
        $arrrs = $this->UrlProcess();
        $accountdetail = $this->AccountModel->getByToken($_COOKIE['token']);
        $accountID = $accountdetail['AccountID'];

        if ($arrrs[0] == "admin") {
            AuthCore::checkAuthentication();
            $userdetail = $this->UserModel->getByAccountID($accountID);
            $this->view("main_layout", [
                "Title" => "Profile",
                "Page" => "/pages/profile",
                "Script" => "updateAdmin",
                "UserProfile" => [
                    'AccountDetail' => $accountdetail,
                    'UserDetail' => $userdetail,
                    ]
            ], "admin");
        } else {
            $customerdetail = $this->CustomerModel->getByAccountID($accountID);
            $this->view("main_layout", [
                "Title" => "Profile",
                "Page" => "Profile",
                "UserProfile" => [
                    'AccountDetail' => $accountdetail,
                    'CustomerDetail' => $customerdetail,
                ]
            ], "user");
        }
    }

    // Cập nhật thông tin người dùng
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu JSON từ request
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if (!$data) {
                echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ"]);
                return;
            }

            // Các dữ liệu cần cập nhật
            $name = $data['name'] ?? '';
            $email = $data['email'] ?? '';
            $phone = $data['phone'] ?? '';
            $birth = $data['birth'] ?? '';
            $idCard = $data['idCard'] ?? '';
            $sex = $data['sex'] ?? '';

            // Kiểm tra định dạng ngày sinh
            if (!empty($birth)) {
                $birthPattern = "/^\d{4}-\d{2}-\d{2}$/";
                if (!preg_match($birthPattern, $birth)) {
                    echo json_encode(["success" => false, "message" => "Ngày sinh không hợp lệ. Định dạng phải là YYYY-MM-DD"]);
                    return;
                }
            }

            // Lấy thông tin tài khoản từ cookie
            $accountdetail = $this->AccountModel->getByToken($_COOKIE['token']);
            $accountID = $accountdetail['AccountID'];

            if (in_array($this->url[0], ['user'])) {
                // Cập nhật thông tin khách hàng dựa trên AccountID
                $resultCustomer = $this->CustomerModel->updateByAccountID($accountID, $name, $phone, $birth, $idCard, $sex);
                // $resultCustomer = $this->CustomerModel->updateByAccountID(2, "Nguyễn Văn A", "0123456789", "2000-01-01", "123456789");
                
                // Cập nhật thông tin người dùng trong bảng Accounts (email)
                $resultAccount = $this->AccountModel->updateUserProfile($email, $_COOKIE["token"]);
                
                // Kết hợp kết quả từ cả hai model
                $result = [
                    'success' => $resultCustomer['success'] && $resultAccount['success'],
                    'message' => $resultCustomer['message'] . ' ' . $resultAccount['message']
                ];

                echo json_encode($result);
                exit;
            } else {
                $resultUser = $this->UserModel->updateByAccountID($accountID, $name, $phone, $birth, $idCard, $sex);
                // $resultCustomer = $this->CustomerModel->updateByAccountID(2, "Nguyễn Văn A", "0123456789", "2000-01-01", "123456789");
                
                // Cập nhật thông tin người dùng trong bảng Accounts (email)
                $resultAccount = $this->AccountModel->updateUserProfile($email, $_COOKIE["token"]);
                
                // Kết hợp kết quả từ cả hai model
                $result = [
                    'success' => $resultUser['success'] && $resultAccount['success'],
                    'message' => $resultUser['message'] . ' ' . $resultAccount['message']
                ];
                echo json_encode($result);
                exit;
            }
        } else {
            echo json_encode(["success" => false, "message" => "Chỉ chấp nhận POST"]);
        }
    }

    public function updatePassword() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if (!$data) {
                echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ"]);
                return;
            }

            $currentPassword = $data['currentPassword'] ?? '';
            $newPassword = $data['newPassword'] ?? '';
            $confirmNewPassword = $data['confirmNewPassword'] ?? '';

            if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
                echo json_encode(['success' => false, 'message' => 'Tất cả các trường đều là bắt buộc']);
                return;
            }

            if ($newPassword !== $confirmNewPassword) {
                echo json_encode(['success' => false, 'message' => 'Mật khẩu mới và xác nhận mật khẩu không khớp']);
                return;
            }

            if (strlen($newPassword) < 6) {
                echo json_encode(['success' => false, 'message' => 'Mật khẩu mới phải có ít nhất 6 ký tự']);
                return;
            }

            $accountdetail = $this->AccountModel->getByToken($_COOKIE['token']);
            if (!$accountdetail) {
                echo json_encode(['success' => false, 'message' => 'Không tìm thấy tài khoản']);
                return;
            }

            $storedPassword = $accountdetail['Password'];
            // echo json_encode([
            //     'OldPass' => $storedPassword,
            //     'CurrentPass' => $currentPassword,
            // ]);
            // return;
            // echo json_encode([
            //     'check' => password_verify($currentPassword, $storedPassword)
            // ]);
            // return ;
            if (!password_verify($currentPassword, $storedPassword)) {
                echo json_encode(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng']);
                return;
            }

            // Cập nhật mật khẩu mới
            $result = $this->AccountModel->changePassword($accountdetail["Email"], $newPassword);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Cập nhật mật khẩu thành công']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Cập nhật mật khẩu thất bại']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Chỉ chấp nhận POST']);
        }
    }

    
    
}

?>
