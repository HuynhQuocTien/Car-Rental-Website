<?php

class OrderApprovalModel extends Database {
    public function __construct() {
        parent::__construct();
    }
    public function getQuery($filter, $input, $args, $lastURL)
    {
        $query = "SELECT o.*, c.FullName, pm.PaymentMethod FROM `RentalOrders` o
            LEFT JOIN `Customers` c ON o.CustomerID = c.CustomerID
            LEFT JOIN `Payments` pm ON o.PaymentID = pm.PaymentID
            WHERE o.UserID IS NULL AND o.Status != -1
        ";
        if ($input) {
            $query = $query . " AND c.FullName LIKE '%{$input}%' OR 
                            o.OrderID LIKE '%{$input}%' )";
        }
        
        return $query;
    } 

    public function getUserIDByToken($accountToken) {
        $query = "SELECT UserID FROM `Accounts` a
            LEFT JOIN `Users` u ON a.AccountID = u.AccountID
         WHERE Token = ? LIMIT 1";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $accountToken);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['UserID'];
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

    public function confirmOrder($orderId, $userId) {
        // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
        $query = "UPDATE `RentalOrders` SET UserID = ? WHERE OrderID = ?";
        
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ii", $userId, $orderId);
        $stmt->execute();

        $query = "UPDATE `RentalOrderDetails` SET Status = 1 WHERE OrderID = ?"; 
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $orderId);
        return $stmt->execute();
    }
}
?>