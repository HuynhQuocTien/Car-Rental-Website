<?php

class Inspections extends Controller {
    public $InspectionModel;
    
    public $vehicleTypesModel;
    public $damageTypesModel;
    public function __construct() {
        parent::__construct();
        $this->InspectionModel = $this->model("InspectionModel");
        $this->vehicleTypesModel = $this->model("VehicleTypeModel");
        $this->damageTypesModel = $this->model("DamageTypeModel");
        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();

        $this->view("main_layout", [
            "Title"=>"Inspections",
            "Page"=>"pages/inspections/inspections",
            "Categories" => $this->InspectionModel->getAllCategories(),
            "Colors" => $this->InspectionModel->getAllColors(),
            "Makes" => $this->InspectionModel->getAllMakes(),
            "Script" => "inspections"
        ],
        "admin");
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
