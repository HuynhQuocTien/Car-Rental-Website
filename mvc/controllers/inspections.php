<?php
// 
class Inspections extends Controller {
    public $InspectionModel;
    public $ColorModel;
    public $MakeModel;
    public $ModelModel;
    public $vehicleTypesModel;
    public $damageTypesModel;
    public $InspectionOrderModel;
    public $UserModel;
    public $DamageTypeModel;
    public function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }

    public function __construct() {
        parent::__construct();
        $this->InspectionModel = $this->model("InspectionModel");
        $this->vehicleTypesModel = $this->model("VehicleTypeModel");
        $this->damageTypesModel = $this->model("DamageTypeModel");
        $this->ColorModel = $this->model("ColorModel");
        $this->MakeModel = $this->model("MakeModel");
        $this->ModelModel = $this->model("ModelModel");
        $this->InspectionOrderModel = $this->model("InspectionOrderModel");
        $this->UserModel = $this->model("UserModel");
        $this->DamageTypeModel = $this->model("DamageTypeModel");
        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();

        $this->view("main_layout", [
            "Title"=>"Inspections",
            "Page"=>"pages/inspections/inspections",
            "Script" => "inspections"
        ],
        "admin");
    }

    public function inspectionOrder(){

            $orderID = $_GET['id'];
            // var_dump($_SESSION["UserID"]);
            // exit;
            $this->view("main_layout", [
                "Title"=>"Inspection $orderID Order",
                "Script"=> "inspectionOrder",
                "Page"=>"/pages/inspections/inspectionOrder",
                "OrderID" => $orderID,
                "Colors" => $this->ColorModel->getAll(),
                "VehicleTypes" => $this->vehicleTypesModel->getAll(),
                "Makes" => $this->MakeModel->getAll(),
                "Models" => $this->ModelModel->getAll(),
                "DamageTypes" => $this->DamageTypeModel->getAll(),
                "Acc" => $_SESSION["UserID"]
            ],
            "admin");
    }

    public function addInspectionForOrderDetail(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ POST request (dữ liệu form)
            $data = [
                "RentalOrderDetailID" => $_POST["RentalOrderDetailID"],
                "UserID" => $_POST["UserID"],
                "InspectionDate" => $_POST["InspectionDate"],
                "InspectionTime" => $_POST["InspectionTime"],
                "TotalFineAmount" => $_POST["TotalFineAmount"]
            ];

            // Gọi model để thêm dữ liệu vào bảng Inspections
            $result = $this->InspectionOrderModel->create($data);

            if ($result) {
                // Nếu thêm thành công
                echo json_encode(["success" => true, "message" => "Inspection added successfully"]);
            } else {
                // Nếu có lỗi khi thêm
                echo json_encode(["success" => false, "message" => "Failed to add inspection"]);
            }
        } else {
            // Trường hợp không phải POST request
            echo json_encode(["success" => false, "message" => "Invalid request method"]);
        }
    }

    public function updateInspectionForOrderDetail(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ POST request (dữ liệu form)
            $data = [
                "RentalOrderDetailID" => $_POST["RentalOrderDetailID1"],
                "UserID" => $_POST["UserID1"],
                "InspectionDate" => $_POST["InspectionDate1"],
                "InspectionTime" => $_POST["InspectionTime1"],
                "TotalFineAmount" => $_POST["TotalFineAmount1"]
            ];
    
            // Gọi model để cập nhật dữ liệu vào bảng Inspections
            $result = $this->InspectionOrderModel->update($data);
    
            if ($result) {
                // Nếu cập nhật thành công
                echo json_encode(["success" => true, "message" => "Inspection updated successfully"]);
            } else {
                // Nếu có lỗi khi cập nhật
                echo json_encode(["success" => false, "message" => "Failed to update inspection"]);
            }
        } else {
            // Trường hợp không phải POST request
            echo json_encode(["success" => false, "message" => "Invalid request method"]);
        }
    }
    


    public function getins() {
        $orderDetailID = $_GET["orderDetailID"] ?? null; 
        if (!$orderDetailID) {
            echo json_encode(['success' => false, 'message' => 'orderDetailID is required']);
            exit;
        }
        $result = $this->InspectionOrderModel->getByOrderDetailID($orderDetailID);
            if ($result) {
                echo json_encode(['success' => true, 'data' => $result]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No inspection data found']);
            }
    
        exit; // Đảm bảo không in gì thêm sau JSON
    }
    
    public function delete() {
        $orderDetailID = $_GET["orderDetailID"] ?? null; 
        if (!$orderDetailID) {
            echo json_encode(['success' => false, 'message' => 'orderDetailID is required']);
            exit;
        }
        $result = $this->InspectionOrderModel->delete($orderDetailID);
            if ($result) {
                echo json_encode(['success' => true, 'data' => "đã xóa"]);
            } else {
                echo json_encode(['success' => false, 'message' => 'chưa xóa']);
            }
    
        exit; // Đảm bảo không in gì thêm sau JSON
    }
   



    public function damagetypes() {
        $this->view("main_layout", [
            "Title"=>"Damage Types",
            "Page"=>"pages/inspections/damagetypes",
            "Script"=>"damagetypes",
            "VehicleTypes"=>$this->vehicleTypesModel->getAll(),
        ],
        "admin");
    }
    public function addDamageType(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = [
                "DamageName" => $_POST["DamageName"],
                "FineAmount" => $_POST["FineAmount"],
                "VehicleTypesID" => $_POST["VehicleTypesID"],
            ];
            $result = $this->damageTypesModel->create($data);
            if($result){
                echo json_encode(["success"=>true]);
            }else{
                echo json_encode(["success"=>false]);
            }   
        }
    }
    public function updateDamageType(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = [
                "DamageTypeID" => $_POST["DamageTypeID"],
                "DamageName" => $_POST["DamageName"],
                "FineAmount" => $_POST["FineAmount"],
                "VehicleTypesID" => $_POST["VehicleTypesID"],
            ];
            $result = $this->damageTypesModel->update($data);
            if($result){
                echo json_encode(["success"=>true]);
            }else{
                echo json_encode(["success"=>false]);
            }   
        }
    }
    public function deleteDamageType(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST["DamageTypeID"];
            $result = $this->damageTypesModel->delete($id);
            if($result){
                echo json_encode(["success"=>true]);
            }else{
                echo json_encode(["success"=>false]);
            }   
        }
    }
    public function deposits() {
        $this->view("main_layout", [
            "Title"=>"Deposits",
            "Page"=>"pages/inspections/deposits",
        ],
        "admin");
    }
}
?>
