<?php

require_once 'Database.php';

class RentalOrderDetailModel extends Database {

    // Create a new rental order detail
    public function createOrderDetail($orderId, $vehicleId, $rentalRate, $returnDate, $userId, $notes, $active, $status) {
        $sql = "INSERT INTO RentalOrderDetails (OrderID, VehiclesID, RentalRate, ReturnDate, UserID, Notes, Active, Status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderId, $vehicleId, $rentalRate, $returnDate, $userId, $notes, $active, $status]);
    }

    // Get order detail by ID
    public function getOrderDetailById($orderDetailId) {
        $sql = "SELECT * FROM RentalOrderDetails WHERE OrderDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$orderDetailId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all details for a specific order
    public function getOrderDetailsByOrder($orderId) {
        $sql = "SELECT * FROM RentalOrderDetails WHERE OrderID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update order detail (including return info)
    public function updateOrderDetail($orderDetailId, $rentalRate, $returnDate, $actualReturnDate, $damagePenalty, $notes, $active, $status) {
        $sql = "UPDATE RentalOrderDetails SET RentalRate = ?, ReturnDate = ?, ActualReturnDate = ?, DamagePenalty = ?, Notes = ?, Active = ?, Status = ? 
                WHERE OrderDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$rentalRate, $returnDate, $actualReturnDate, $damagePenalty, $notes, $active, $status, $orderDetailId]);
    }

    // Delete an order detail
    public function deleteOrderDetail($orderDetailId) {
        $sql = "DELETE FROM RentalOrderDetails WHERE OrderDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderDetailId]);
    }
}

?>
