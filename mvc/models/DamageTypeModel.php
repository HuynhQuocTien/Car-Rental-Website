<?php

require_once 'Database.php';

class DamageTypeModel extends Database {

    // Create a new damage type
    public function createDamageType($damageName, $fineAmount, $vehicleTypeId) {
        $sql = "INSERT INTO DamageTypes (DamageName, FineAmount, VehicleTypesID) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageName, $fineAmount, $vehicleTypeId]);
    }

    // Get a damage type by ID
    public function getDamageTypeById($damageTypeId) {
        $sql = "SELECT * FROM DamageTypes WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$damageTypeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all damage types
    public function getAllDamageTypes() {
        $sql = "SELECT * FROM DamageTypes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a damage type
    public function updateDamageType($damageTypeId, $damageName, $fineAmount, $vehicleTypeId) {
        $sql = "UPDATE DamageTypes SET DamageName = ?, FineAmount = ?, VehicleTypesID = ? WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageName, $fineAmount, $vehicleTypeId, $damageTypeId]);
    }

    // Delete a damage type
    public function deleteDamageType($damageTypeId) {
        $sql = "DELETE FROM DamageTypes WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageTypeId]);
    }
}

?>
