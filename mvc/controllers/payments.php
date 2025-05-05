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
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        /**
         * 
         *
         * @author CTT VNPAY
         */
        require_once 'config/vnpay_config.php'; // Tách cấu hình riêng

        $data = json_decode(file_get_contents("php://input"), true);
        $orderId = $data['orderId'] ?? null;
        $amount = $data['amount'] ?? null;

        if (!$orderId || !$amount) {
            echo json_encode(['success' => false, 'message' => 'Thiếu thông tin đơn hàng']);
            return;
        }

        $vnp_TxnRef = $orderId; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $amount * 25000; // Số tiền thanh toán
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = 'NCB'; // Mã phương thức thanh toán mặc định
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'; 

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        } 
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
        $secureHash = isset($vnp_HashSecret) ? hash_hmac('sha512', $hashData, $vnp_HashSecret) : null;
        $this->view("main_layout", [
            "Title" => "VNPAY Return",
            "Page" => "vnpay-return",
            "inputData" => $inputData,
        ]);
    }

    public function vnPayReturn() {
        $vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : null;
        $vnp_Amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] : null;
        $vnp_TxnRef = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : null;

        $message = "";
        $success = false;

        if ($vnp_ResponseCode !== null && $vnp_ResponseCode === '00') {
            $message = "Thanh toán thành công!";
            $success = true;
        } else {
            $message = "Thanh toán thất bại! Mã lỗi: " . htmlspecialchars($vnp_ResponseCode);
        }

        $this->view("main_layout", [
            "Title" => "VNPAY Return",
            "Page" => "vnpay-return",
            "PaymentResult" => [
                "success" => $success,
                "message" => $message,
                "amount" => $vnp_Amount ? $vnp_Amount / 100 : null,
                "transactionRef" => $vnp_TxnRef,
            ],
        ]);
    }
}
?>
