<?php

class Approval extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"About - Car Rental",
            "Page"=>"pages/orders/approval",
            "Script"=> "orders/approval",
        ],
        "admin");
    }

    function confirmOrderInDatabase($orderId) {
        return true;
    }

    // Phương thức xác nhận đơn hàng
    function confirmOrder() {
        // Lấy dữ liệu POST (ID đơn hàng)
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'])) {
            $orderId = $data['id']; // Lấy ID từ body request

            // Giả sử bạn có hàm kiểm tra và xác nhận đơn hàng
            $result = $this->confirmOrderInDatabase($orderId);

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