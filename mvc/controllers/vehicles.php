<?php

class Vehicles extends Controller {
    public $vehicleModel;
    public $colorModel;
    public $modoelModel;
    public $makeModel;
    public $vehicleTypeModel;

    public function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }
    public function __construct(){
        $this->vehicleModel = $this->model("VehicleModel");;
        $this->colorModel = $this->model("ColorModel");
        $this->modoelModel = $this->model("ModelModel");
        $this->makeModel = $this->model("MakeModel");
        $this->vehicleTypeModel = $this->model("VehicleTypeModel");
    }
    public function default() {
        $arrrs = $this->UrlProcess();
        if($arrrs[0] == "admin"){
            $this->view("main_layout", [
                "Title"=>"Vehicles",
                "Script"=> "vehicle",
                "Page"=>"/pages/vehicles/vehicles",
                "Colors"=>$this->colorModel->getAll(),
                "Makes"=>$this->makeModel->getAll(),
                "Models"=>$this->modoelModel->getAll(),
                "VehicleTypes"=>$this->vehicleTypeModel->getAll(),


            ],
            "admin");
        } else {
            $this->view("main_layout", [
                "Title"=>"Vehicles",
                "Page"=>"vehicles",
            ],
            "user");
        }
    }
    public function addvehicles() {
        $arrrs = $this->UrlProcess();
        if($arrrs[0] == "admin"){
            $this->view("main_layout", [
                "Title"=>"Add Vehicles",
                "Script"=> "vehicle",
                "Page"=>"/pages/vehicles/addvehicles",
                "Colors"=>$this->colorModel->getAll(),
                "Makes"=>$this->makeModel->getAll(),
                "Models"=>$this->modoelModel->getAll(),
                "VehicleTypes"=>$this->vehicleTypeModel->getAll(),


            ],
            "admin");
        } else {
            $this->view("main_layout", [
                "Title"=>"Vehicles",
                "Page"=>"vehicles",
            ],
            "user");
        }

    }
    public function vehiclecategory() {
        $this->view("main_layout", [
            "Title"=>"Vehicle Category",
            "Page"=>"/pages/vehicles/vehiclecategory",
            "VehicleTypes"=>$this->vehicleTypeModel->getAll(),

        ],
        "admin");
    }
    public function colors() {
        $this->view("main_layout", [
            "Title"=>"Colors",
            "Page"=>"/pages/vehicles/colors",
            "Colors"=>$this->colorModel->getAll(),

        ],
        "admin");
    }
    public function makes() {
        $this->view("main_layout", [
            "Title"=>"Makes",
            "Page"=>"/pages/vehicles/makes"
        ],
        "admin");
    }
    public function models() {
        $this->view("main_layout", [
            "Title"=>"Models",
            "Page"=>"/pages/vehicles/models"
        ],
        "admin");
    }
    public function addvehicle() {
        $this->view("main_layout", [
            "Title"=>"Add Vehicle",
            "Page"=>"/pages/vehicles/addvehicle",
        ],
        "admin");
    }
}
?>