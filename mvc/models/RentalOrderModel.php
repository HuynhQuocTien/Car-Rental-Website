<?php
class RentalOrderModel extends Database {

    // Create a new rental order
    public function createRentalOrder($customerId, $vehicleId, $returnDate, $totalAmount, $damagePenalty, $address, $status, $paymentId) {
        $sql = "INSERT INTO RentalOrders (CustomerID, VehicleID, ActualReturnDate, TotalAmount, DamagePenalty, Address, Status, PaymentID)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$customerId, $vehicleId, $returnDate, $totalAmount, $damagePenalty, $address, $status, $paymentId]);
    }

    // Get a rental order by ID
    public function getRentalOrderById($orderId) {
        $sql = "SELECT * FROM RentalOrders WHERE OrderID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all rental orders
    public function getAllRentalOrders() {
        $sql = "SELECT * FROM RentalOrders";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update rental order information
    public function updateRentalOrder($orderId, $customerId, $vehicleId, $returnDate, $totalAmount, $damagePenalty, $address, $status, $paymentId) {
        $sql = "UPDATE RentalOrders SET CustomerID = ?, VehicleID = ?, ActualReturnDate = ?, TotalAmount = ?, DamagePenalty = ?, Address = ?, Status = ?, PaymentID = ? 
                WHERE OrderID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$customerId, $vehicleId, $returnDate, $totalAmount, $damagePenalty, $address, $status, $paymentId, $orderId]);
    }

    // Delete a rental order
    public function deleteRentalOrder($orderId) {
        $sql = "DELETE FROM RentalOrders WHERE OrderID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderId]);
    }
}

?>