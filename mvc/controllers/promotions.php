<?php
class Promotions extends Controller {
    public $promotionModel;
    public $vehicleModel;
    public function __construct() {
        parent::__construct();
        $this->promotionModel =$this->model("PromotionModel");
        $this->vehicleModel =$this->model("VehicleModel");

        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Promotions",
            "Page"=>"pages/promotions",
            "Vehicles" => $this->vehicleModel->getAll(),
            "Script" =>"promotions",
        ],
        "admin");
    }
    public function get(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['UserID'] ?? '0';
            $result = $this->promotionModel->get($id);
            echo json_encode([
                'success' => $result != null,
                'message' => $result != null ? 'User found!' : 'User not found!',
                'data' => $result
            ]);
        }
    }
    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'PromotionName' => $_POST["name"] ?? null,
                'PromotionCode' => $_POST["code"] ?? null,
                'DiscountType' => $_POST["discountType"] ?? null,
                'DiscountValue' => $_POST["discountValue"] ?? null,
                'VehicleID' => $_POST["vehicleId"] ?? NULL,
                'StartDate' => $_POST["startDate"] ?? 0,
                'UserID' => $_SESSION["UserID"] ?? null,
                'EndDate' => $_POST["endDate"] ?? 0,
                'Description' => $_POST["description"] ?? 0,
                'Status' => $_POST["status"] ?? 1,
            ];
            $result = $this->promotionModel->create($data);
            echo json_encode(['success' => $result]);
        }
    }
    
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleID = $_POST["promotionID"] ?? null;
            
            if (!$vehicleID) {
                echo json_encode(['success' => false, 'message' => 'ID is required']);
                return;
            }

            $data = [
                'PromotionID' => $_POST["promotionID"] ?? null,
                'PromotionName' => $_POST["name"] ?? null,
                'PromotionCode' => $_POST["code"] ?? null,
                'DiscountType' => $_POST["discountType"] ?? null,
                'DiscountValue' => $_POST["discountValue"] ?? null,
                'VehicleID' => $_POST["vehicleId"] ?? NULL,
                'StartDate' => $_POST["startDate"] ?? 0,
                'UserID' => $_SESSION["UserID"] ?? null,
                'EndDate' => $_POST["endDate"] ?? 0,
                'Description' => $_POST["description"] ?? 0,
                'Status' => $_POST["status"] ?? 1,
            ];
            $result = $this->promotionModel->update( $data);
            echo json_encode(['success' => $result]);
        }
    }
    
    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $promotionId = $_POST["promotionId"] ?? null;
            
            if (!$promotionId) {
                echo json_encode(['success' => false, 'message' => 'Vehicle ID is required']);
                return;
            }

            $result = $this->promotionModel->delete($promotionId);
            echo json_encode(['success' => $result]);
        }
    }
    

    public function getQuery($filter, $input, $args, $lastURL){

        $sql = $this->promotionModel->getQuery($filter, $input, $args, $lastURL);
        return $sql;
    }
}
?>