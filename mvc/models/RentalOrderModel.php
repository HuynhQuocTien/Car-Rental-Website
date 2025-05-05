<?php
class RentalOrderModel extends Database {
    public function __construct() {
        parent::__construct();
    }
    public function getQuery($filter, $input, $args, $lastURL)
    {
        $query = "SELECT o.*, c.FullName, pm.PaymentMethod FROM `RentalOrders` o
            LEFT JOIN `Customers` c ON o.CustomerID = c.CustomerID
            LEFT JOIN `Payments` pm ON o.PaymentID = pm.PaymentID
        ";
        // if ($input) {
        //     $query = $query . " AND (p.PromotionName LIKE '%{$input}%')";
        // }
        $query = $query . " ORDER BY o.OrderID  ASC";
        return $query;
    } 

    public function createRentalOrder($data) {
        $this->con->begin_transaction();
        $stmt = null;
        $stmtDetail = null;
        $stmtPayment = null;
        try {
            // 1. Insert vào bảng Order
            $stmtPayment = $this->con->prepare("INSERT INTO `Payments` (`PaymentMethod`, `PaymentDate`, `Amount`, `Status`) 
            VALUES (?, ?, ?, ?);");
            $paymentMethod = intval($data['payment']['paymentMethod']);
            $paymentDate = $data['payment']['paymentDate'];
            $amount = floatval($data['payment']['amount']);
            $paymentStatus = intval($data['payment']['status']);
            $stmtPayment->bind_param("isdi", 
                $paymentMethod, 
                $paymentDate, 
                $amount, 
                $paymentStatus);
            $stmtPayment->execute();

            $paymentID = $this->con->insert_id; // Lấy ID thanh toán mới

            $stmt = $this->con->prepare("INSERT INTO `RentalOrders` (`CustomerID`, `UserID`, `OrderDate`, `RentalDate`, `TotalAmount`, `Address`,
             `PromotionID`, `Status`, `PaymentID`) 
            VALUES (?, NULL, ?, NULL, ?, ?, NULL, '1', ?);");

            $customerID = intval($data['customerId']);
            $orderDate = $data['orderDate'];
            $rentalDate = $data['rentalDate'];
            $totalAmount = floatval($data['totalPrice']);
            $address = $data['address'];
            $promotionID = $data['promotionId'] !== "" ? intval($data['promotionId']) : null;
            $status = intval($data['status']);
            $stmt->bind_param("isdsi", 
                $customerID, 
                $orderDate, 
                $totalAmount, 
                $address,
                $paymentID);
            $stmt->execute();

            $orderId = $this->con->insert_id; // Lấy ID đơn hàng mới
             // 2. Insert các dòng OrderDetails
            $stmtDetail = $this->con->prepare("INSERT INTO RentalOrderDetails (OrderID, VehicleDetailID, RentalRate, RentalType,
            ReturnDate, ActualReturnDate, DamagePenalty, UserID, Notes, Active, Status) 
            VALUES (?, ?, ?, ?, ?, NULL, 0, NULL, ?, 0, 0)");
            foreach ($data['orderDetails'] as $detail) {
                $stmtDetail->bind_param(
                    "iiddss",
                    $orderId,
                    $detail['VehicleDetailID'],
                    $detail['RentalRate'],
                    $detail['RentalType'],
                    $detail['ReturnDate'],
                    $detail['Notes'],
            );
                $stmtDetail->execute();
            }
    
            $this->con->commit(); // Thành công → Commit
            return $orderId; // Trả về ID đơn hàng mới tạo
        } catch (Exception $e) {
            $this->con->rollback(); // Có lỗi → Rollback
            echo json_encode(['success' => false, 'message' => 'Failed to save order: ' . $e->getMessage()]);
            return false;
        } finally {
            $stmt->close();
            $stmtDetail->close();
            $stmtPayment->close();
            $this->con->close();
        }
    }

    public function getRentalOrderByID($id) {
        $query = "SELECT o.*, MakeName, ColorName, ModelName, NameType FROM `RentalOrderDetails` o 
            LEFT JOIN `VehicleDetails` vd ON vd.VehicleDetailID = o.VehicleDetailID
            LEFT JOIN `Vehicles` v ON vd.VehicleID = v.VehicleID
            LEFT JOIN `Colors` c ON c.ColorID = vd.ColorID
            LEFT JOIN `Makes` m ON m.MakeID = v.MakeID
            LEFT JOIN `Models` mo ON mo.ModelID = v.ModelID 
            LEFT JOIN `VehicleTypes` vt ON vt.VehicleTypesID = v.VehicleTypesID
            WHERE o.OrderID = ?
        ";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getOrderByCustomerId($id) {
        $query = "SELECT o.*, MakeName, ColorName, ModelName, NameType FROM `RentalOrders` o 
        LEFT JOIN `VehicleDetails` vd ON vd.VehicleDetailID = o.VehicleDetailID
        LEFT JOIN `Vehicles` v ON vd.VehicleID = v.VehicleID
        LEFT JOIN `Colors` c ON c.ColorID = vd.ColorID
        LEFT JOIN `Makes` m ON m.MakeID = v.MakeID
        LEFT JOIN `Models` mo ON mo.ModelID = v.ModelID 
        LEFT JOIN `VehicleTypes` vt ON vt.VehicleTypesID = v.VehicleTypesID
        WHERE o.OrderID = ?
    ";
    }
}
?>