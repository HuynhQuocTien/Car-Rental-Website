<?php

class Vehicles extends Controller {
    public $vehicleModel;
    public $colorModel;
    public $modelModel;
    public $makeModel;
    public $vehicleTypeModel;

    public function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }
    public function UrlProcessLast() {
        if (isset($_GET["url"])) {
            $urlParts = explode("/", filter_var(trim($_GET["url"], "/")));
            return end($urlParts); // Lấy phần tử cuối cùng của mảng
        }
        return null;
    }
    public function __construct(){
        $this->vehicleModel = $this->model("VehicleModel");;
        $this->colorModel = $this->model("ColorModel");
        $this->modelModel = $this->model("ModelModel");
        $this->makeModel = $this->model("MakeModel");
        $this->vehicleTypeModel = $this->model("VehicleTypeModel");
        parent::__construct();
        require_once "./mvc/core/Pagination.php";
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
                "Models"=>$this->modelModel->getAll(),
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
                "Models"=>$this->modelModel->getAll(),
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
            "Script"=> "vehiclecategory",
            "Page"=>"/pages/vehicles/vehiclecategory",
            "VehicleTypes"=>$this->vehicleTypeModel->getAll(),

        ],
        "admin");
    }
    public function colors() {
        $this->view("main_layout", [
            "Title"=>"Colors",
            "Page"=>"/pages/vehicles/colors",
            "Script"=> "colors",
            "Colors"=>$this->colorModel->getAll(),

        ],
        "admin");
    }
    public function makes() {
        $this->view("main_layout", [
            "Title"=>"Makes",
            "Page"=>"/pages/vehicles/makes",
            "Script"=> "makes",
        ],
        "admin");
    }
    public function models() {
        $this->view("main_layout", [
            "Title"=>"Models",
            "Page"=>"/pages/vehicles/models",
            "Script"=> "models",
            "Makes"=>$this->makeModel->getAll(),
            "VehicleTypes"=>$this->vehicleTypeModel->getAll(),
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
    public function addVehicleType()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $typeName = $_POST["name"];
            $result = $this->vehicleTypeModel->create($typeName);
            echo $result;
        }
    }
    public function updateVehicleType() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $typeName = $_POST["name"];
            $result = $this->vehicleTypeModel->update($id,$typeName);
            echo $result;
        }
    }
    public function addColor()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $result = $this->colorModel->create($name);
            echo $result;
        }
    }
    public function updateColor() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $result = $this->colorModel->update($id,$name);
            echo $result;
        }
    }
    public function addMake()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $country = $_POST["country"];
            $result = $this->makeModel->create($name,$country);
            echo $result;
        }
    }
    public function updateMake() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $country = $_POST["country"];
            $result = $this->makeModel->update($id,$name,$country);
            echo $result;
        }
    }

    public function addModel()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $makeId = $_POST["makeId"];
            $vehicleType = $_POST["vehicleType"];
            $result = $this->modelModel->create($name,$makeId,$vehicleType);
            echo $result;
        }
    }
    public function updateModel() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $makeId = $_POST["makeId"];
            $vehicleType = $_POST["vehicleType"];
            $result = $this->modelModel->update($id,$name,$makeId,$vehicleType);
            echo $result;
        }
    }

    public function getQuery($filter, $input, $args) {
        $lastURL = "Vehicles";
        switch ($lastURL) {
            case "vehiclecategory":
                $lastURL = "VehicleTypes";
                $query = $this->vehicleTypeModel->getQuery($filter, $input, $args, $lastURL);
                break;
            case "colors":
                $lastURL = "Colors";
                $query = $this->colorModel->getQuery($filter, $input, $args, $lastURL);
                break;
            case "makes":
                $lastURL = "Makes";
                $query = $this->makeModel->getQuery($filter, $input, $args, $lastURL);
                break;
            case "models":
                $lastURL = "Models";
                $query = $this->modelModel->getQuery($filter, $input, $args, $lastURL);
                break;
            case "vehicles":
                $lastURL = "Vehicles";
                $query = $this->vehicleModel->getQuery($filter, $input, $args, $lastURL);
                break;
        }
        return $query;
    }
}
?>