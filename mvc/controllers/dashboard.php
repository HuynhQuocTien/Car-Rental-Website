<?php

class Dashboard extends Controller {
    public $PaymentModel;
    public $VehicleDetailModel;
    public $AccountModel; 
    public $RentalOrderDetailModel;
    public $VehicleModel;
    public $ColorModel;
    public function __construct() {
        $this->PaymentModel = $this->model("PaymentModel");
        $this->VehicleDetailModel = $this->model("VehicleDetailModel");
        $this->AccountModel = $this->model("AccountModel");
        $this->RentalOrderDetailModel = $this->model("RentalOrderDetailModel");
        $this->VehicleModel = $this->model("VehicleModel");
        $this->ColorModel = $this->model("ColorModel");
        parent::__construct();
    }
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Dashboard",
            "Page"=>"pages/dashboard",
            "Script" => "dashboard",
        ],
        "admin");
    }

    public function vehicleDetail(){
        $vehicleDetailID = $_GET["VehicleDetailID"];
        $data = $this->VehicleDetailModel->getById($vehicleDetailID);
        echo json_encode($data);
        exit;
    } 

    public function vehicle(){
        $vehicleID = $_GET["VehicleID"];
        $data = $this->VehicleModel->getById($vehicleID);
        echo json_encode($data);
        exit;
    } 

    public function color(){
        $colorID = $_GET["ColorID"];
        $data = $this->ColorModel->getByID($colorID);
        echo json_encode($data);
        exit;
    }

    public function test(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if (!$data) {
                echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ"]);
                return;
            }

            $timeRange = $data['timeRange'] ?? null;
            if (!$timeRange) {
                echo json_encode(["success" => false, "message" => "Không có timeRange"]);
                return;
            }

            $today = new DateTime();
            $startDate = null;
            $endDate = $today->format('Y-m-d 23:59:59');

            switch ($timeRange) {
                case 'this_week':
                    $startOfWeek = clone $today;
                    $startOfWeek->modify('-6 days');
                    $startDate = $startOfWeek->format('Y-m-d 00:00:00');
                    break;

                case 'previous_week':
                    $startOfPrevWeek = clone $today;
                    $startOfPrevWeek->modify('-13 days');
                    $endOfPrevWeek = clone $today;
                    $endOfPrevWeek->modify('-7 days');
                    $startDate = $startOfPrevWeek->format('Y-m-d 00:00:00');
                    $endDate = $endOfPrevWeek->format('Y-m-d 23:59:59');
                    break;

                case 'this_month':
                    $startOfMonth = (new DateTime('first day of this month'));
                    $startDate = $startOfMonth->format('Y-m-d 00:00:00');
                    break;

                case 'previous_month':
                    $startOfPrevMonth = (new DateTime('first day of last month'));
                    $endOfPrevMonth = (new DateTime('last day of last month'));
                    $startDate = $startOfPrevMonth->format('Y-m-d 00:00:00');
                    $endDate = $endOfPrevMonth->format('Y-m-d 23:59:59');
                    break;

                default:
                    echo json_encode(["success" => false, "message" => "Giá trị timeRange không hợp lệ"]);
                    return;
            }

            $payMentResult = $this->PaymentModel->getDataByDateRange($startDate, $endDate);
            $vehicleDetailResult = $this->VehicleDetailModel->getAll();
            $accountResult = $this->AccountModel->getDataByDateRange($startDate, $endDate);
            $rentalOrderDetailResult = $this->RentalOrderDetailModel->getAll();

            echo json_encode([
                "success" => true,
                "startDate" => $startDate,
                "endDate" => $endDate,
                "payMentResult" => $payMentResult,
                "vehicleDetailResult" => $vehicleDetailResult,
                "accountResult" => $accountResult,
                "rentalOrderDetailResult" => $rentalOrderDetailResult,
                "timeRange" => $timeRange
            ]);
            return;
        }
    }

}
?>
