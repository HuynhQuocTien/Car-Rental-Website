<?php


class PaymentModel extends Database {

    public function createPayment($orderId, $paymentDate, $paymentMethod, $amount, $status) {
        $sql = "INSERT INTO Payments (OrderID, PaymentDate, PaymentMethod, Amount, Status) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderId, $paymentDate, $paymentMethod, $amount, $status]);
    }

    public function getPaymentById($paymentId) {
        $sql = "SELECT * FROM Payments WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$paymentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPayments() {
        $sql = "SELECT * FROM Payments";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePayment($paymentId, $orderId, $paymentDate, $paymentMethod, $amount, $status) {
        $sql = "UPDATE Payments SET OrderID = ?, PaymentDate = ?, PaymentMethod = ?, Amount = ?, Status = ?
                WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderId, $paymentDate, $paymentMethod, $amount, $status, $paymentId]);
    }

    public function deletePayment($paymentId) {
        $sql = "DELETE FROM Payments WHERE PaymentID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$paymentId]);
    }
}

?>