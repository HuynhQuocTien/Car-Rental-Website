<?php

class Users extends Controller {
    public $accountModel;
    public $userModel;
    public $RoleModel;
    public $cloudinaryModel;
    public function __construct() {
        parent::__construct();
        $this->accountModel = $this->model("AccountModel");
        $this->userModel = $this->model("UserModel");
        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Users",
            "Page"=>"pages/users",
            "Script"=>"users",
            "Roles"=>$this->RoleModel->getAll(),
        ],
        "admin");
    }
    public function addUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Thu thập dữ liệu từ form
            $data = [
                'FullName' => $_POST['FullName'] ?? '',
                'PhoneNumber' => $_POST['PhoneNumber'] ?? '',
                'IdentityCard' => $_POST['IdentityCard'] ?? '',
                'RoleID' => $_POST['RoleID'] ?? null,
                'DateOfBirth' => $_POST['DateOfBirth'] ?? null,
                'Username' => $_POST['Username'] ?? '',
                'Email' => $_POST['Email'] ?? '',
                'Password' => password_hash($_POST['Password'] ?? '', PASSWORD_DEFAULT), // Băm mật khẩu
                'Sex' => $_POST['Sex'] ?? 0,
                'Active' => isset($_POST['Active']) ? 1 : 0,
                'ProfilePicture' =>  "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg" // Sẽ cập nhật sau khi upload ảnh
            ];
    
            // Kiểm tra ảnh đại diện
            if (!empty($_FILES['ProfilePicture']['tmp_name'])) {
                try {
                    // Upload ảnh đại diện lên Cloudinary (hoặc lưu vào server)
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['ProfilePicture']['tmp_name']);
                    $data['ProfilePicture'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload ảnh: " . $e->getMessage());
                }
            }
            // Lưu dữ liệu người dùng
            $result = $this->userModel->create($data);
    
            // Trả về kết quả dưới dạng JSON
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'User added successfully!' : 'Failed to add user!',
                'data' => $data
            ]);
        }
    }
    public function updateUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Thu thập dữ liệu từ form
            $data = [
                'UserID' => $_POST['UserID'] ?? null,
                'AccountID'=> $_POST['AccountID'] ?? null,
                'FullName' => $_POST['FullName'] ?? '',
                'PhoneNumber' => $_POST['PhoneNumber'] ?? '',
                'IdentityCard' => $_POST['IdentityCard'] ?? '',
                'RoleID' => $_POST['RoleID'] ?? null,
                'DateOfBirth' => $_POST['DateOfBirth'] ?? null,
                'Username' => $_POST['Username'] ?? '',
                'Email' => $_POST['Email'] ?? '',                
                'Sex' => $_POST['Sex'] ?? 0,
                'Active' => isset($_POST['Active']) ? 1 : 0,
                'ProfilePicture' =>  "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg" // Sẽ cập nhật sau khi upload ảnh
            ];
    
            // Kiểm tra ảnh đại diện
            if (!empty($_FILES['ProfilePicture']['tmp_name'])) {
                try {
                    // Upload ảnh đại diện lên Cloudinary (hoặc lưu vào server)
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['ProfilePicture']['tmp_name']);
                    $data['ProfilePicture'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload ảnh: " . $e->getMessage());
                }
            } 
            // Cập nhật dữ liệu người dùng
            $result = $this->userModel->update($data);
    
            // Trả về kết quả dưới dạng JSON
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'User updated successfully!' : 'Failed to update user!',
                'data' => $data
            ]);
        }
    }
    public function deleteUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_POST['UserID'] ?? null;
            $accId = $_POST['AccountID'] ?? null;
            if(empty($userId) || empty($accId)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid user ID or account ID!'
                ]);
                return;
            }
            // Kiểm tra xem người dùng có quyền xóa không
            $result = $this->userModel->delete($userId,$accId);
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'User deleted successfully!' : 'Failed to delete user!'
            ]);
        }
    }
    
    public function checkUserName() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['Username'] ?? '';
            $userID = $_POST['UserID'] ?? '0';
            $result = $this->accountModel->checkUsername($username, $userID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null? 'Username already exists!' : 'Username is valid!'
            ]);
        }
    }
    public function checkEmail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['Email'] ?? '';
            $userID = $_POST['UserID'] ?? '0';
            $result = $this->accountModel->checkEmail($email, $userID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'Email already exists!' : 'Email is valid!'
            ]);
        }
    }
    public function checkPhoneNumber() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $phone = $_POST['PhoneNumber'] ?? '';
            $userID = $_POST['UserID'] ?? '0';
            $result = $this->userModel->checkPhone($phone, $userID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'Phone number already exists!' : 'Phone number is valid!'
            ]);
        }
    }
    public function checkIdentityCard() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $IDCard = $_POST['IdentityCard'] ?? '';
            $userID = $_POST['UserID'] ?? '0';
            $result = $this->userModel->checkIdentityCard($IDCard, $userID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'Identity card already exists!' : 'Identity card is valid!'
            ]);
        }
    }

    public function get(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['UserID'] ?? '0';
            $result = $this->userModel->get($id);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'User found!' : 'User not found!',
                'data' => $result
            ]);
        }
    }
    public function getQuery($filter, $input, $args, $lastURL){

        $sql = $this->userModel->getQuery($filter, $input, $args, $lastURL);
        return $sql;
    }

    public function getUserId() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_SESSION['UserID'] ?? "0";
            echo json_encode([
                'success' => $id != null,
                'message' => $id != null ? 'User found!' : 'User not found!',
                'data' => $id
            ]);
        }
    }
}
?>
