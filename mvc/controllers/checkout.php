<?php
    class Checkout extends Controller {
        public function default() {
            $this->view("main_layout", [
                "Page" => "checkout",
                "Title" => "Checking out",
                "Script" => "checkout",
            ], "user");
        }
        // public function save() {
        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         $inputData = json_decode(file_get_contents('php://input'), true);
        
        //         if (!isset($inputData['carts']) || empty($inputData['carts'])) {
        //             http_response_code(400);
        //             echo json_encode([
        //                 'success' => false,
        //                 'message' => 'Dữ liệu carts không hợp lệ'
        //             ]);
        //             exit();
        //         }
        //         $_SESSION['checkout_carts'] = $inputData['carts'];
        
        //         echo json_encode([
        //             'success' => true,
        //             'message' => 'Lưu carts thành công'
        //         ]);
        //     } else {
        //         http_response_code(405);
        //         echo json_encode([
        //             'success' => false,
        //             'message' => 'Phương thức không hợp lệ'
        //         ]);
        //     }
        // }
        // public function page() {
        //     $carts = isset($_SESSION['checkout_carts']) ? $_SESSION['checkout_carts'] : [];
            
        // }
        public function createOrder() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $order = $_POST['order'];
                
            }
        }
    }
?>