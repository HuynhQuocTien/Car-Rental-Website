<?php


class DamageTypeModel extends Database {

    public function createDamageType($damageName, $fineAmount, $vehicleTypeId) {
        $sql = "INSERT INTO DamageTypes (DamageName, FineAmount, VehicleTypesID) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageName, $fineAmount, $vehicleTypeId]);
    }

    public function getDamageTypeById($damageTypeId) {
        $sql = "SELECT * FROM DamageTypes WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$damageTypeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllDamageTypes() {
        $sql = "SELECT * FROM DamageTypes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateDamageType($damageTypeId, $damageName, $fineAmount, $vehicleTypeId) {
        $sql = "UPDATE DamageTypes SET DamageName = ?, FineAmount = ?, VehicleTypesID = ? WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageName, $fineAmount, $vehicleTypeId, $damageTypeId]);
    }

    public function deleteDamageType($damageTypeId) {
        $sql = "DELETE FROM DamageTypes WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageTypeId]);
    }
}

?>
