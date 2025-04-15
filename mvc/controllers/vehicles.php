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
            if (!isset($_SESSION['add_vehicle_id'])) {
                // Không có quyền truy cập nếu chưa bấm nút js-add-detail
                header("Location: /index.php");
                exit;
            }
            
            $vehicleId = $_SESSION['add_vehicle_id'];

            $this->view("main_layout", [
                "Title"=>"Add Vehicles",
                "Script"=> "addvehicles",
                "Page"=>"/pages/vehicles/addvehicles",
                "Vehicle"=>$this->vehicleModel->getById($vehicleId),
                "Colors"=>$this->colorModel->getAll(),
            ],
            "admin");
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
    public function getVehicle(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleID = $_POST["id"] ?? null;
            
            if (!$vehicleID) {
                echo json_encode(['success' => false, 'message' => 'Vehicle ID is required']);
                return;
            }

            $result = $this->vehicleModel->getById($vehicleID);
            
            echo json_encode(['success' => true, 'data' => $result]);
        }
    }
    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'makeID' => $_POST["makeID"] ?? null,
                'modelID' => $_POST["modelID"] ?? null,
                'vehicleTypeID' => $_POST["vehicleTypeID"] ?? null,
                'seats' => $_POST["seats"] ?? null,
                'hourlyPrice' => $_POST["hourlyPrice"] ?? 0,
                'dailyPrice' => $_POST["dailyPrice"] ?? 0,
                'weeklyPrice' => $_POST["weeklyPrice"] ?? 0,
                'monthlyPrice' => $_POST["monthlyPrice"] ?? 0,
                'weeklyDiscount' => $_POST["weeklyDiscount"] ?? 0,
                'monthlyDiscount' => $_POST["monthlyDiscount"] ?? 0,
                'promotionID' => $_POST["promotionID"] ?? 0,
                'description' => $_POST["description"] ?? '',
                'active' => isset($_POST["active"]) && $_POST["active"] == "1" ? 1 : 0,
                'feature' => isset($_POST["feature"]) && $_POST["feature"] == "1" ? 1 : 0
            ];
            $result = $this->vehicleModel->create($data);
            echo json_encode(['success' => $result]);
        }
    }
    
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleID = $_POST["vehicleID"] ?? null;
            
            if (!$vehicleID) {
                echo json_encode(['success' => false, 'message' => 'Vehicle ID is required']);
                return;
            }

            $data = [
                'makeID' => $_POST["makeID"] ?? null,
                'modelID' => $_POST["modelID"] ?? null,
                'vehicleTypeID' => $_POST["vehicleTypeID"] ?? null,
                'seats' => $_POST["seats"] ?? null,
                'hourlyPrice' => $_POST["hourlyPrice"] ?? 0,
                'dailyPrice' => $_POST["dailyPrice"] ?? 0,
                'weeklyPrice' => $_POST["weeklyPrice"] ?? 0,
                'monthlyPrice' => $_POST["monthlyPrice"] ?? 0,
                'weeklyDiscount' => $_POST["weeklyDiscount"] ?? 0,
                'monthlyDiscount' => $_POST["monthlyDiscount"] ?? 0,
                'promotionID' => $_POST["promotionID"] ?? 0,
                'description' => $_POST["description"] ?? '',
                'active' => isset($_POST["active"]) && $_POST["active"] == "1" ? 1 : 0,
                'feature' => isset($_POST["feature"]) && $_POST["feature"] == "1" ? 1 : 0
            ];

            $result = $this->vehicleModel->update($vehicleID, $data);
            echo json_encode(['success' => $result]);
        }
    }
    
    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleID = $_POST["id"] ?? null;
            
            if (!$vehicleID) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Vehicle ID is required']);
                return;
            }

            $result = $this->vehicleModel->delete($vehicleID);
            
            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
        }
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
    public function deleteModel() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $result = $this->modelModel->delete($id);
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

    public function saveVehicleID() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vehicle_id'])) {
            $_SESSION['add_vehicle_id'] = $_POST['vehicle_id'];
            echo json_encode(['success' => true,'data'=> $_SESSION['add_vehicle_id']]);
        } else {
            echo json_encode(['success' => false, 'data' => 'No data']);
        }
    }
}
?>