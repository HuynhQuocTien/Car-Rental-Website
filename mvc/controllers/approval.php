<?php

class Approval extends Controller {
<<<<<<< Updated upstream
    public $orderApprovalModel;
    public function __construct() {
        parent::__construct();

        $this->orderApprovalModel = $this->model("OrderApprovalModel");
        
=======
    public $orderAppovalModel; 
    public function __construct() {
        parent::__construct();
        $this->orderAppovalModel = new OrderApprovalModel();

>>>>>>> Stashed changes
        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"About - Car Rental",
            "Page"=>"pages/orders/approval",
            "Script"=> "orders/approval",
        ],
        "admin");
    }

<<<<<<< Updated upstream
    public function detail() {
        $this->view("main_layout", [
            "Title"=>"About - Car Rental",
            "Page"=>"pages/orders/detail",
            "Script"=> "orders/detail",
        ],
        "admin");
=======
    function confirmOrderInDatabase($orderId) {
        $this->orderAppovalModel->confirmOrder($orderId, );
>>>>>>> Stashed changes
    }

    function confirmOrderInDatabase($orderId, $userId) {
        return $this->orderApprovalModel->confirmOrder($orderId, $userId);
    }
    // Phương thức xác nhận đơn hàng
    function confirmOrder() {
        // Lấy dữ liệu POST (ID đơn hàng)
        $data = json_decode(file_get_contents("php://input"), true);
        $accountToken = $_COOKIE['token'];
        $userId = $this->orderApprovalModel->getUserIDByToken($accountToken);
        if (isset($data['id'])) {
            $orderId = $data['id']; // Lấy ID từ body request
            // Giả sử bạn có hàm kiểm tra và xác nhận đơn hàng
            $result = $this->confirmOrderInDatabase($orderId, $userId);
            // Kiểm tra kết quả xác nhận
            if ($result) {
                // Trả về JSON với thông tin thành công
                echo json_encode([
                    'success' => true,
                    'message' => 'Đơn hàng ' . $orderId . ' đã được xác nhận!'
                ]);
            } else {
                // Trả về JSON với lỗi
                echo json_encode([
                    'success' => false,
                    'message' => 'Không thể xác nhận đơn hàng ' . $orderId . '.'
                ]);
            }
        } else {
            // Trả về lỗi nếu không có 'id' trong body
            echo json_encode([
                'success' => false,
                'message' => 'Không có ID trong yêu cầu.'
            ]);
        }
    }
}
?>