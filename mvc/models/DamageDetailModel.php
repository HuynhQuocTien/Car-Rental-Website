<?php


class DamageDetailModel extends Database {

    public function createDamageDetail($damageTypeId) {
        $sql = "INSERT INTO DamageDetails (DamageTypeID) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageTypeId]);
    }

    public function getDamageDetailById($damageDetailId) {
        $sql = "SELECT * FROM DamageDetails WHERE DamageDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$damageDetailId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDamageDetailsByType($damageTypeId) {
        $sql = "SELECT * FROM DamageDetails WHERE DamageTypeID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$damageTypeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteDamageDetail($damageDetailId) {
        $sql = "DELETE FROM DamageDetails WHERE DamageDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$damageDetailId]);
    }
}

?>
