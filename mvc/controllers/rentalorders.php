<?php

class RentalOrders extends Controller {
    public $rentalOrderModel;
    public $orderDetailModel;
    public function __construct() {
        parent::__construct();
        $this->rentalOrderModel = $this->model("RentalOrderModel");
        $this->orderDetailModel = $this->model("OrderDetailModel");
        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Rental Orders",
            "Page"=>"pages/orders/rentalorders",
            "Script" => "orders/rentalorders",
        ],
        "admin");
    }
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $order = $data['order'] ?? null;
            $result = $this->rentalOrderModel->createRentalOrder($order);
            // var_dump($order);
            
            if($result) {
                echo json_encode([
                'success' => true,
                'message' => 'Order created successfully',
                'orderID' => $result
                ]);
            } else {
                echo json_encode([
                'success' => false,
                'message' => 'Failed to create order'
                ]);
            }
        } else {
            echo json_encode([
            'success' => false,
            'message' => 'Invalid request method'
            ]);
        }
    }
    public function getRentalOrderByID($id) {
        $rentalOrder = $this->rentalOrderModel->getRentalOrderByID($id);
        echo json_encode($rentalOrder);
    }

    public function detail() {
        // $detail = $this->rentalOrderModel->getDetail($id);
        // if(isset($_GET["id"]) == false || !$_GET["id"]) {
        //     header("Location: /admin/rentalorders");
        //     exit;
        // }
        $id = $_GET["id"];
        $rentalOrder = $this->rentalOrderModel->getRentalOrderByID($id);

        $this->view("main_layout", [
            "Title"=> "Detail of order " . $id,
            "Page"=>"pages/orders/detail",
            "Script" => "orders/detail",
            "rentalOrder" => $rentalOrder,
        ],
        "admin");
        // echo json_encode($detail);
    }

    public function viewOrder() {
        $this->view("main_layout", [
            "Title"=>"Rental Orders",
            "Page"=>"pages/orders/rentalorders",
            "Script" => "orders/rentalorders",
        ]);
    }

    public function userOrder() {
        $accountToken = $_COOKIE['token'];
        $userId = $this->rentalOrderModel->getCustomerIDbyToken($accountToken);
        $order = $this->rentalOrderModel->getOrderByCustomerId($userId);
        var_dump($order);
        $this->view("main_layout", [
            "Title"=>"Rental Orders",
            "Page"=>"orders",
            "Script" => "orders",
            "order"=> $order,
        ]);
    }

    public function cancelOrder() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $orderId = $data['orderId'] ?? null;
            $result = $this->rentalOrderModel->cancelRentalOrder($orderId);
            
            if($result) {
                echo json_encode([
                'success' => true,
                'message' => 'Order canceled successfully'
                ]);
            } else {
                echo json_encode([
                'success' => false,
                'message' => 'Failed to cancel order'
                ]);
            }
        } else {
            echo json_encode([
            'success' => false,
            'message' => 'Invalid request method'
            ]);
        }
    }
}
?>
