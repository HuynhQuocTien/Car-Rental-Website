<?php

class VehicleConditionModel extends Database {

    public function addCondition($description, $image, $status) {
        $sql = "INSERT INTO VehicleCondition (Description, Image, Status) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$description, $image, $status]);
    }

    public function getConditionById($conditionId) {
        $sql = "SELECT * FROM VehicleCondition WHERE ConditionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$conditionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllConditions() {
        $sql = "SELECT * FROM VehicleCondition";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCondition($conditionId, $description, $image, $status) {
        $sql = "UPDATE VehicleCondition SET Description = ?, Image = ?, Status = ? WHERE ConditionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$description, $image, $status, $conditionId]);
    }

    public function deleteCondition($conditionId) {
        $sql = "DELETE FROM VehicleCondition WHERE ConditionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$conditionId]);
    }
}

?>