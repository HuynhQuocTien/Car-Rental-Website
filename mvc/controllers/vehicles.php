<?php

class Vehicles extends Controller {
    public function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }
    public function default() {
        $arrrs = $this->UrlProcess();
        if($arrrs[0] == "admin"){
            $this->view("main_layout", [
                "Title"=>"Vehicles",
                "Page"=>"/pages/vehicles/vehicles",
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
            "Page"=>"/pages/vehicles/vehiclecategory"
        ],
        "admin");
    }
    public function colors() {
        $this->view("main_layout", [
            "Title"=>"Colors",
            "Page"=>"/pages/vehicles/colors"
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
            "Page"=>"/pages/vehicles/addvehicle"
        ],
        "admin");
    }
}
?>