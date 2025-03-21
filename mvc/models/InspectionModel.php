<?php


class InspectionModel extends Database {

    public function createInspection($rentalOrderDetailId, $inspectionDate, $conditionBefore, $conditionAfter, $damageId, $userId, $totalFineAmount, $conditionId) {
        $sql = "INSERT INTO Inspections (RentalOrderDetailID, InspectionDate, ConditionBefore, ConditionAfter, DamageID, UserID, TotalFineAmount, ConditonID) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$rentalOrderDetailId, $inspectionDate, $conditionBefore, $conditionAfter, $damageId, $userId, $totalFineAmount, $conditionId]);
    }
    public function getInspectionById($inspectionId) {
        $sql = "SELECT * FROM Inspections WHERE InspectionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$inspectionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInspectionsByOrder($rentalOrderDetailId) {
        $sql = "SELECT * FROM Inspections WHERE RentalOrderDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$rentalOrderDetailId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateInspection($inspectionId, $conditionBefore, $conditionAfter, $damageId, $totalFineAmount, $conditionId) {
        $sql = "UPDATE Inspections SET ConditionBefore = ?, ConditionAfter = ?, DamageID = ?, TotalFineAmount = ?, ConditonID = ? 
                WHERE InspectionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$conditionBefore, $conditionAfter, $damageId, $totalFineAmount, $conditionId, $inspectionId]);
    }

    public function deleteInspection($inspectionId) {
        $sql = "DELETE FROM Inspections WHERE InspectionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$inspectionId]);
    }
}

?>