<?php

require_once 'Database.php';

class VehicleTypeModel extends Database {

    // Create a new vehicle type
    public function createVehicleType($nameType) {
        $sql = "INSERT INTO VehicleTypes (NameType) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nameType]);
    }

    // Get a vehicle type by ID
    public function getVehicleTypeById($vehicleTypeId) {
        $sql = "SELECT * FROM VehicleTypes WHERE VehicleTypesID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$vehicleTypeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all vehicle types
    public function getAllVehicleTypes() {
        $sql = "SELECT * FROM VehicleTypes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a vehicle type
    public function updateVehicleType($vehicleTypeId, $nameType) {
        $sql = "UPDATE VehicleTypes SET NameType = ? WHERE VehicleTypesID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nameType, $vehicleTypeId]);
    }

    // Delete a vehicle type
    public function deleteVehicleType($vehicleTypeId) {
        $sql = "DELETE FROM VehicleTypes WHERE VehicleTypesID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$vehicleTypeId]);
    }
}

?>
