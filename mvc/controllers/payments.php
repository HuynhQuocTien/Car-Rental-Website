<?php

class Payments extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Payments",
            "Page"=>"payments",
        ],
        "admin");
    }

    
    public function createVnpayPayment() {
        require_once 'config/vnpay_config.php'; // Tách cấu hình riêng

        $data = json_decode(file_get_contents("php://input"), true);
        $orderId = $data['orderId'] ?? null;
        $amount = $data['amount'] ?? null;

        if (!$orderId || !$amount) {
            echo json_encode(['success' => false, 'message' => 'Thiếu thông tin đơn hàng']);
            return;
        }

        $vnp_TxnRef = time();
        $vnp_OrderInfo = "Thanh toán đơn hàng #$orderId";
        $vnp_Amount = $amount * 25000;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        ];
    
        ksort($inputData);
        $hashdata = urldecode(http_build_query($inputData));
        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $inputData['vnp_SecureHash'] = $vnp_SecureHash;
    
        $vnp_Url = $vnp_UrlBase . "?" . http_build_query($inputData);
    
        echo json_encode([
            'success' => true,
            'redirectUrl' => $vnp_Url
        ]);
    }

    public function handleVnpayReturn() {
        require_once 'config/vnpay_config.php';
    
        $inputData = [];
        foreach ($_GET as $key => $value) {
            if ($key != "vnp_SecureHash") {
                $inputData[$key] = $value;
            }
        }
        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    
        if ($secureHash === $_GET['vnp_SecureHash']) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                // ✅ Gọi Model để update đơn hàng: đã thanh toán
                echo json_encode([
                    'success' => true,
                    'message' => 'Thanh toán thành công!',
                    'amount' => $_GET['vnp_Amount'] / 100,
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Thanh toán thất bại!',
                    'responseCode' => $_GET['vnp_ResponseCode'],
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Mã bảo mật không hợp lệ!',
            ]);
        }
    }
}
?>
