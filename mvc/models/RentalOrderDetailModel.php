<?php

class RentalOrderDetailModel extends Database {

    // public function createOrderDetail($orderId, $vehicleId, $rentalRate, $returnDate, $userId, $notes, $active, $status) {
    //     $sql = "INSERT INTO RentalOrderDetails (OrderID, VehiclesID, RentalRate, ReturnDate, UserID, Notes, Active, Status) 
    //             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([$orderId, $vehicleId, $rentalRate, $returnDate, $userId, $notes, $active, $status]);
    // }

    // public function getOrderDetailById($orderDetailId) {
    //     $sql = "SELECT * FROM RentalOrderDetails WHERE OrderDetailID = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$orderDetailId]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // public function getOrderDetailsByOrder($orderId) {
    //     $sql = "SELECT * FROM RentalOrderDetails WHERE OrderID = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$orderId]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function updateOrderDetail($orderDetailId, $rentalRate, $returnDate, $actualReturnDate, $damagePenalty, $notes, $active, $status) {
    //     $sql = "UPDATE RentalOrderDetails SET RentalRate = ?, ReturnDate = ?, ActualReturnDate = ?, DamagePenalty = ?, Notes = ?, Active = ?, Status = ? 
    //             WHERE OrderDetailID = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([$rentalRate, $returnDate, $actualReturnDate, $damagePenalty, $notes, $active, $status, $orderDetailId]);
    // }

    // public function deleteOrderDetail($orderDetailId) {
    //     $sql = "DELETE FROM RentalOrderDetails WHERE OrderDetailID = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([$orderDetailId]);
    // }
    
    public function getAll()
    {
        $sql = "SELECT * FROM `RentalOrderDetails`";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

}

?>
