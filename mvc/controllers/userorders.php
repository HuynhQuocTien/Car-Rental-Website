<?php
    class Userorders extends Controller {
        public $userOrderModel;
        public $rentalOrderModel;
        public function __construct() {
            parent::__construct();
            $this->userOrderModel = $this->model("UserOrderModel");
            $this->rentalOrderModel = $this->model("RentalOrderModel");

            require_once "./mvc/core/Pagination.php";
        }
        public function default() {
            $this->view("main_layout", [
                "Title"=>"User Orders",
                "Page"=>"userorders",
                "Script" => "userorders",
            ]);
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
                "Page"=>"detail-userorders",
                "Script" => "detail-useroders",
                "rentalOrder" => $rentalOrder,
            ]);
            // echo json_encode($detail);
        }
    }
?>