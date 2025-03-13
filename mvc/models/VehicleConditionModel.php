<?php

require_once 'Database.php';

class VehicleConditionModel extends Database {

    // Add a new vehicle condition
    public function addCondition($description, $image, $status) {
        $sql = "INSERT INTO VehicleCondition (Description, Image, Status) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$description, $image, $status]);
    }

    // Get a vehicle condition by ID
    public function getConditionById($conditionId) {
        $sql = "SELECT * FROM VehicleCondition WHERE ConditionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$conditionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all vehicle conditions
    public function getAllConditions() {
        $sql = "SELECT * FROM VehicleCondition";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a vehicle condition
    public function updateCondition($conditionId, $description, $image, $status) {
        $sql = "UPDATE VehicleCondition SET Description = ?, Image = ?, Status = ? WHERE ConditionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$description, $image, $status, $conditionId]);
    }

    // Delete a vehicle condition
    public function deleteCondition($conditionId) {
        $sql = "DELETE FROM VehicleCondition WHERE ConditionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$conditionId]);
    }
}

?>