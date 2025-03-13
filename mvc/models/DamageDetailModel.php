<?php

require_once 'Database.php';

class DamageDetailModel extends Database {

    // Create a new damage detail
    public function createDamageDetail($damageTypeId) {
        $sql = "INSERT INTO DamageDetails (DamageTypeID) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageTypeId]);
    }

    // Get a damage detail by ID
    public function getDamageDetailById($damageDetailId) {
        $sql = "SELECT * FROM DamageDetails WHERE DamageDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$damageDetailId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all damage details for a specific damage type
    public function getDamageDetailsByType($damageTypeId) {
        $sql = "SELECT * FROM DamageDetails WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$damageTypeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete a damage detail
    public function deleteDamageDetail($damageDetailId) {
        $sql = "DELETE FROM DamageDetails WHERE DamageDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageDetailId]);
    }
}

?>
