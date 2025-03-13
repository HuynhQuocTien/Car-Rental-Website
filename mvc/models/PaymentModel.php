<?php

require_once 'Database.php';

class PaymentModel extends Database {

    // Create a new payment record
    public function createPayment($orderId, $paymentDate, $paymentMethod, $amount, $status) {
        $sql = "INSERT INTO Payments (OrderID, PaymentDate, PaymentMethod, Amount, Status) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderId, $paymentDate, $paymentMethod, $amount, $status]);
    }

    // Get a payment by ID
    public function getPaymentById($paymentId) {
        $sql = "SELECT * FROM Payments WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$paymentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all payments
    public function getAllPayments() {
        $sql = "SELECT * FROM Payments";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a payment record
    public function updatePayment($paymentId, $orderId, $paymentDate, $paymentMethod, $amount, $status) {
        $sql = "UPDATE Payments SET OrderID = ?, PaymentDate = ?, PaymentMethod = ?, Amount = ?, Status = ?
                WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderId, $paymentDate, $paymentMethod, $amount, $status, $paymentId]);
    }

    // Delete a payment record
    public function deletePayment($paymentId) {
        $sql = "DELETE FROM Payments WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$paymentId]);
    }
}

?>