<?php

class Home extends Controller {
    public $vehicleDetailModel;
    public $vehicleModel;
    public function __construct() {
        $this->vehicleDetailModel = $this->model("VehicleDetailModel");
        $this->vehicleModel = $this->model("VehicleModel");
    }
    public function default() {
        if(isset($_COOKIE['token'])){
            AuthCore::checkAuthentication();
        }
        $this->view("main_layout", [
            "Title"=>" Home -  Car Rental",
            "Page"=>"home",
            "FeatureVehicles"=>$this->vehicleDetailModel->getAllFeature(),
        ],
        "user"); //User hay admin
    }
}
?>