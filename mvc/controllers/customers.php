<?php

class Customers extends Controller {
    public $customerModel;
    public $accountModel;
    public $cloudinaryModel;

    public function __construct() {
        $this->customerModel = $this->model("CustomerModel");
        $this->accountModel = $this->model("AccountModel");
        parent::__construct();
        require_once "./mvc/core/Pagination.php";

    }
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Customers",
            "Page"=>"pages/customers",
            "Script"=>"customer",
        ],
        "admin");
    }
    public function add() {
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
                'Password' => password_hash($_POST['Password'] ?? '', PASSWORD_DEFAULT),
                'Sex' => $_POST['Sex'] ?? 0,
                'CustomerActive' => isset($_POST['CustomerActive']) ? 1 : 0,
                'AccountActive' => isset($_POST['AccountActive']) ? 1 : 0,
                'ProfilePicture' => "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg",
                'IDCardBefore' => null,
                'IDCardAfter' => null,
            ];
            // Upload ảnh đại diện
            if (!empty($_FILES['ProfilePicture']['tmp_name'])) {
                try {
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['ProfilePicture']['tmp_name']);
                    $data['ProfilePicture'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload ảnh đại diện: " . $e->getMessage());
                }
            }

            // Upload CMND mặt trước
            if (!empty($_FILES['IDCardBefore']['tmp_name'])) {
                try {
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['IDCardBefore']['tmp_name']);
                    $data['IDCardBefore'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload CMND mặt trước: " . $e->getMessage());
                }
            }

            // Upload CMND mặt sau
            if (!empty($_FILES['IDCardAfter']['tmp_name'])) {
                try {
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['IDCardAfter']['tmp_name']);
                    $data['IDCardAfter'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload CMND mặt sau: " . $e->getMessage());
                }
            }
            
            // Lưu dữ liệu người dùng
            $result = $this->customerModel->create($data);
    
            // Trả về kết quả dưới dạng JSON
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Customer added successfully!' : 'Failed to add customer!',
                'data' => $data
            ]);
        }
    }
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Thu thập dữ liệu từ form
            $data = [
                'CustomerID' => $_POST['CustomerID'] ?? null,
                'AccountID' => $_POST['AccountID'] ?? null,
                'TotalOrdered' => $_POST['TotalOrdered'] ?? 0,                
                'TotalFine' => $_POST['TotalFine'] ?? 0,
                'TotalAmount' => $_POST['TotalAmount'] ?? 0,                
                'FullName' => $_POST['FullName'] ?? '',
                'PhoneNumber' => $_POST['PhoneNumber'] ?? '',
                'IdentityCard' => $_POST['IdentityCard'] ?? '',
                'RoleID' => $_POST['RoleID'] ?? null,
                'DateOfBirth' => $_POST['DateOfBirth'] ?? null,
                'Username' => $_POST['Username'] ?? '',
                'Email' => $_POST['Email'] ?? '',
                'Password' => password_hash($_POST['Password'] ?? '', PASSWORD_DEFAULT),
                'Sex' => $_POST['Sex'] ?? 0,
                'CustomerActive' => isset($_POST['CustomerActive']) ? 1 : 0,
                'AccountActive' => isset($_POST['AccountActive']) ? 1 : 0,
                'ProfilePicture' => "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg",
                'IDCardBefore' => null,
                'IDCardAfter' => null,
            ];
            // Upload ảnh đại diện
            if (!empty($_FILES['ProfilePicture']['tmp_name'])) {
                try {
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['ProfilePicture']['tmp_name']);
                    $data['ProfilePicture'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload ảnh đại diện: " . $e->getMessage());
                }
            }

            // Upload CMND mặt trước
            if (!empty($_FILES['IDCardBefore']['tmp_name'])) {
                try {
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['IDCardBefore']['tmp_name']);
                    $data['IDCardBefore'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload CMND mặt trước: " . $e->getMessage());
                }
            }

            // Upload CMND mặt sau
            if (!empty($_FILES['IDCardAfter']['tmp_name'])) {
                try {
                    $uploadResult = $this->cloudinaryModel->uploadImage($_FILES['IDCardAfter']['tmp_name']);
                    $data['IDCardAfter'] = $uploadResult['secure_url'];
                } catch (Exception $e) {
                    error_log("Lỗi khi upload CMND mặt sau: " . $e->getMessage());
                }
            }
            // Cập nhật dữ liệu người dùng
            $result = $this->customerModel->update($data);
    
            // Trả về kết quả dưới dạng JSON
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Customer updated successfully!' : 'Failed to update customer!',
                'data' => $data
            ]);
        }
    }
    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customerId = $_POST['CustomerID'] ?? null;
            $accId = $_POST['AccountID'] ?? null;
            if(empty($customerId) || empty($accId)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid customer ID or account ID!'
                ]);
                return;
            }
            // Kiểm tra xem người dùng có quyền xóa không
            $result = $this->customerModel->delete($customerId,$accId);
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Customer deleted successfully!' : 'Failed to delete customer!'
            ]);
        }
    }
    
    public function checkUserName() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['Username'] ?? '';
            $customerID = $_POST['CustomerID'] ?? '0';
            $result = $this->accountModel->checkUsername($username, $customerID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null? 'Username already exists!' : 'Username is valid!'
            ]);
        }
    }
    public function checkEmail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['Email'] ?? '';
            $customerID = $_POST['CustomerID'] ?? '0';
            $result = $this->accountModel->checkEmail($email, $customerID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'Email already exists!' : 'Email is valid!'
            ]);
        }
    }
    public function checkPhoneNumber() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $phone = $_POST['PhoneNumber'] ?? '';
            $customerID = $_POST['CustomerID'] ?? '0';
            $result = $this->customerModel->checkPhone($phone, $customerID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'Phone number already exists!' : 'Phone number is valid!'
            ]);
        }
    }
    public function checkIdentityCard() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $IDCard = $_POST['IdentityCard'] ?? '';
            $customerID = $_POST['CustomerID'] ?? '0';
            $result = $this->customerModel->checkIdentityCard($IDCard, $customerID);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'Identity card already exists!' : 'Identity card is valid!'
            ]);
        }
    }

    public function get(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['CustomerID'] ?? '0';
            $result = $this->customerModel->get($id);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'Customer found!' : 'Customer not found!',
                'data' => $result
            ]);
        }
    }

    public function getCustomerId() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_SESSION['CustomerID'] ?? "0";
            echo json_encode([
                'success' => $id != null,
                'message' => $id != null ? 'Customer found!' : 'Customer not found!',
                'data' => $id
            ]);
        }
    }


}
?>