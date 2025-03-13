<?php

class VehicleImageModel extends Database {

    public function addVehicleImage($vehicleId, $imageUrl, $isPrimary = 0) {
        $sql = "INSERT INTO VehicleImages (VehicleID, ImageURL, IsPrimary) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$vehicleId, $imageUrl, $isPrimary]);
    }

    public function getImagesByVehicleId($vehicleId) {
        $sql = "SELECT * FROM VehicleImages WHERE VehicleID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrimaryImage($vehicleId) {
        $sql = "SELECT * FROM VehicleImages WHERE VehicleID = ? AND IsPrimary = 1 LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateImage($imageId, $imageUrl, $isPrimary) {
        $sql = "UPDATE VehicleImages SET ImageURL = ?, IsPrimary = ? WHERE ImageID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$imageUrl, $isPrimary, $imageId]);
    }

    public function deleteImage($imageId) {
        $sql = "DELETE FROM VehicleImages WHERE ImageID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$imageId]);
    }
}

?>