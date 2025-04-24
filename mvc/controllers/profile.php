<?php

class Profile extends Controller {

    public $AccountModel;
    public $CustomerModel;
    public $UserModel;
    public $url;

    public function UrlProcess(){
      if (isset($_GET["url"])) {
          return explode("/", filter_var(trim($_GET["url"], "/")));
      }
      return null;
    }
    // public function UrlProcessLast() {
    //     if (isset($_GET["url"])) {
    //         $urlParts = explode("/", filter_var(trim($_GET["url"], "/")));
    //         return end($urlParts); // Lấy phần tử cuối cùng của mảng
    //     }
    //     return null;
    // }
    public function __construct(){
      $this->AccountModel = $this->model("AccountModel");
      $this->CustomerModel = $this->model("CustomerModel");
      $this->UserModel = $this->model("UserModel");

      $this->url = $this->UrlProcess(); 
      parent::__construct();
        // require_once "./mvc/core/Pagination.php";
    }

    public function default() {
        $arrrs = $this->UrlProcess();
        $accountdetail = $this->AccountModel->getByToken($_COOKIE['token']);
        $accountID = $accountdetail['AccountID'];
        if($arrrs[0] == "admin"){
            AuthCore::checkAuthentication();
            $userdetail = $this->UserModel->getByAccountID($accountID);
            $this->view("main_layout", [
                "Title"=>"Profile",
                // "Script"=> "vehicle",
                "Page"=>"/pages/profile",
                "UserProfile" => [
                  'AccountDetail' => $accountdetail,
                  'UserDetail' => $userdetail,
                ]
            ],
            "admin");
        } else {
            $customerdetail = $this->CustomerModel->getByAccountID($accountID);
            $this->view("main_layout", [
                "Title"=>"Profile",
                // "Script"=> "vehicle",
                "Page"=>"Profile",
                // "VehicleTypes"=>$this->vehicleTypeModel->getAll(),
                "UserProfile" => [
                  'AccountDetail' => $accountdetail,
                  'CustomerDetail' => $customerdetail,
                ]

            ],
            "user");
        }
    }

    public function g() {
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
  
          // Gọi hàm cập nhật trong model (giả sử có sẵn hàm updateProfile)
          if (in_array($this->url[0], ['user'])) {
              $result = $this->AccountModel->updateUserProfile($email, $_COOKIE["token"]);
              echo json_encode($result);
          } 
          // else if (in_array($this->url[0], ['admin'])) {
          //     $result = $this->accountModel->updateAdminProfile($name, $email, $phone, $birth, $idCard);
          //     echo json_encode($result);
          // } 
          else {
              echo json_encode(["success" => false, "message" => "Sai đường dẫn"]);
          }
      } else {
          echo json_encode(["success" => false, "message" => "Chỉ chấp nhận POST"]);
      }
    }
  
  }


?>