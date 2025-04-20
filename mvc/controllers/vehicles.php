<?php

class Vehicles extends Controller {
    public $vehicleModel;
    public $colorModel;
    public $modelModel;
    public $makeModel;
    public $vehicleTypeModel;

    public $vehicleDetailModel;

    public $vehicleImageModel;
    public $cloudinaryModel;

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
        $this->vehicleDetailModel = $this->model("VehicleDetailModel");
        $this->cloudinaryModel = $this->model("CloudinaryModel");
        $this->vehicleImageModel = $this->model("VehicleImageModel");
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
                "Script"=> "vehicle",
                "Page"=>"vehicles",
                "VehicleTypes"=>$this->vehicleTypeModel->getAll(),

            ],
            "user");
        }
    }
    public function viewDetail() {
        $arrrs = $this->UrlProcess();
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if($arrrs[0] == "user" && $id != null){
            $this->view("main_layout", [
                "Title"=>"Detail Vehicles",
                "Script"=> "vehicleDetail",
                "Page"=>"detail-vehicle",
                "Vehicle"=>$this->vehicleDetailModel->getVehicleDetails($id),
                "VehicleImages"=>[1,2,3,4,5],
                "id"=>$id,

            ],
            "user");
        } else $this->view("single_layout", ["Page" => "error/404","Title" => "Lỗi !"]);
    }
    public function getVehicleTest(){

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
                'active' => isset($_POST["active"]) && $_POST["active"] == "1" ? 1 : 0,
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
                'active' => isset($_POST["active"]) && $_POST["active"] == "1" ? 1 : 0,
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
    public function addDetail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'VehicleID' => $_POST["vehicle-id"] ?? null,
                'HourlyPrice' => $_POST["hourly-price"] ?? null,
                'DailyPrice' => $_POST["daily-price"] ?? null,
                'WeeklyPrice' => $_POST["weekly-price"] ?? null,
                'MonthlyPrice' => $_POST["monthly-price"] ?? 0,
                'Description' => $_POST["description"] ?? '',
                'FuelConsumption' => $_POST["fuel-consumption"] ?? '',
                'Transmission' => $_POST["transmission"] ?? '',
                'FuelType' => $_POST["fuel-type"] ?? '',
                'Year' => $_POST["year"] ?? '',
                'LicensePlateNumber' => $_POST["license-plate"] ?? '',
                'ColorID' => $_POST["color-id"] ?? '',
                'Mileage' => $_POST["mileage"] ?? '',
                'Active' => isset($_POST["is-active"]) && $_POST["is-active"] == "1" ? 1 : 0,
            ];
    
            // Save vehicle details and get the ID
            $result = $this->vehicleDetailModel->create($data);
            $check = false;
            $vehicleDetailID = $this->vehicleDetailModel->getIDMax();
            // Process uploaded images
            if (!empty($_FILES['upload-image']['name'][0]) && $result) {
                $uploadedFiles = $_FILES['upload-image'];
                $isPrimaryList = $_POST['is-primary'] ?? []; // array of 0/1 flags
    
                $imageData = [];
                for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
                    $tmpFile = $uploadedFiles['tmp_name'][$i];
    
                    if (is_uploaded_file($tmpFile)) {
                        try {
                            // Upload to Cloudinary
                            $uploadResult = $this->cloudinaryModel->uploadImage($tmpFile);
    
                            // Determine if this image is primary
                            $isPrimary = isset($isPrimaryList[$i]) && $isPrimaryList[$i] == "1" ? 1 : 0;
    
                            // Prepare data
                            $imageData[] = [
                                'VehicleDetailID' => $vehicleDetailID,
                                'ImageURL' => $uploadResult['secure_url'],
                                'IsPrimary' => $isPrimary
                            ];
                            $dataImage = [
                                'VehicleDetailID' => $vehicleDetailID,
                                'ImageURL' => $uploadResult['secure_url'],
                                'IsPrimary' => $isPrimary
                            ];
                            // Save image data to DB
                            if (!empty($imageData)) {
                                $check = true;
                                $this->vehicleImageModel->create($dataImage);
                            } else{
                                echo json_encode([
                                    'error'=> 'No image data found',
                                    'success' => false,
                                ]);                                                                
                                }
                        } catch (Exception $e) {
                            error_log("Upload failed: " . $e->getMessage());
                            continue;
                        }
                    }
                }
                
            }
    
            echo json_encode([
                'success' => $check && $result,
                'AddDetail' => $result,
                'AddImage' => $check,
                'vehicleDetailID' => $vehicleDetailID
            ]);
        }
    }
    public function checkLicensePlate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $licensePlate = $_POST["licensePlate"] ?? null;
            $excludeId = $_POST["excludeId"] ?? null;
            if (!$licensePlate) {
                echo json_encode(['success' => false, 'message' => 'License plate number is required']);
                return;
            }

            $isAvailable = $this->vehicleDetailModel->checkLicensePlateNumber($licensePlate, $excludeId);
            
            echo json_encode([
                'success' => $isAvailable,
                'isAvailable' => $isAvailable,
                'message' => $isAvailable 
                    ? 'License plate number is available' 
                    : 'License plate number already exists'
            ]);
        }
    }
    public function saveImage() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        }
            $vehicleDetailID = $this->vehicleDetailModel->getIDMax();
            $uploadedFiles = $_FILES['upload-image'];

            $uploadedUrls = [];

        for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
        $tmpFile = $uploadedFiles['tmp_name'][$i];

        if (is_uploaded_file($tmpFile)) {
            try {
                $uploadResult = $this->cloudinaryModel->uploadImage($tmpFile);
                $uploadedUrls[] = $uploadResult['secure_url']; // Lưu URL này vào DB nếu cần
            } catch (Exception $e) {
                // Ghi log hoặc xử lý lỗi
                error_log("Upload failed: " . $e->getMessage());
            }
        }
    }

    echo json_encode([
        'status' => 'success',
        'urls' => $uploadedUrls
    ]);
        
            echo json_encode(["status" => "success"]);
        }
    public function getDetail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleID = $_POST["id"] ?? null;
            
            if (!$vehicleID) {
                echo json_encode(['success' => false, 'message' => 'Vehicle ID is required']);
                return;
            }

            $result = $this->vehicleDetailModel->getById($vehicleID);
            
            echo json_encode(['success' => true, 'data' => $result]);
        }
    }
    public function updateDetail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleDetailID = $_POST["vehicle-detail-id"] ?? null;
            
            if (!$vehicleDetailID) {
                echo json_encode(['success' => false, 'message' => 'Vehicle Detail ID is required']);
                return;
            }
    
            $data = [
                'VehicleID' => $_POST["vehicle-id"] ?? null,
                'HourlyPrice' => $_POST["hourly-price"] ?? null,
                'DailyPrice' => $_POST["daily-price"] ?? null,
                'WeeklyPrice' => $_POST["weekly-price"] ?? null,
                'MonthlyPrice' => $_POST["monthly-price"] ?? 0,
                'Description' => $_POST["description"] ?? '',
                'FuelConsumption' => $_POST["fuel-consumption"] ?? '',
                'Transmission' => $_POST["transmission"] ?? '',
                'FuelType' => $_POST["fuel-type"] ?? '',
                'Year' => $_POST["year"] ?? '',
                'LicensePlateNumber' => $_POST["license-plate"] ?? '',
                'ColorID' => $_POST["color-id"] ?? '',
                'Mileage' => $_POST["mileage"] ?? '',
                'Active' => isset($_POST["is-active"]) && $_POST["is-active"] == "1" ? 1 : 0,
            ];
    
            // Kiểm tra biển số xe trước khi cập nhật
            if (!empty($data['LicensePlateNumber'])) {
                $isLicenseAvailable = $this->vehicleDetailModel->checkLicensePlateNumber(
                    $data['LicensePlateNumber'], 
                    $vehicleDetailID
                );
                
                if (!$isLicenseAvailable) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Biển số xe đã tồn tại trong hệ thống'
                    ]);
                    return;
                }
            }
    
            // Cập nhật thông tin xe
            $updateResult = $this->vehicleDetailModel->update($vehicleDetailID, $data);
            $imageUpdateResult = false;
    
            // Xử lý hình ảnh nếu có
            if (!empty($_FILES['upload-image']['name'][0]) && $updateResult) {
                $uploadedFiles = $_FILES['upload-image'];
                $isPrimaryList = $_POST['is-primary'] ?? [];
                $deleteImages = $_POST['delete-images'] ?? []; // Danh sách ảnh cần xóa
    
                // Xóa các ảnh được chọn
                if (!empty($deleteImages)) {
                    foreach ($deleteImages as $imageId) {
                        $this->vehicleImageModel->delete($imageId);
                    }
                }
    
                // Thêm ảnh mới
                for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
                    $tmpFile = $uploadedFiles['tmp_name'][$i];
    
                    if (is_uploaded_file($tmpFile)) {
                        try {
                            $uploadResult = $this->cloudinaryModel->uploadImage($tmpFile);
                            $isPrimary = isset($isPrimaryList[$i]) && $isPrimaryList[$i] == "1" ? 1 : 0;
    
                            $imageData = [
                                'VehicleDetailID' => $vehicleDetailID,
                                'ImageURL' => $uploadResult['secure_url'],
                                'IsPrimary' => $isPrimary
                            ];
    
                            $imageUpdateResult = $this->vehicleImageModel->create($imageData);
                        } catch (Exception $e) {
                            error_log("Upload failed: " . $e->getMessage());
                            continue;
                        }
                    }
                }
            }
    
            echo json_encode([
                'success' => $updateResult,
                'UpdateDetail' => $updateResult,
                'UpdateImage' => $imageUpdateResult,
                'vehicleDetailID' => $vehicleDetailID
            ]);
        }
    }
    
    public function deleteDetail() {
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

}
?>