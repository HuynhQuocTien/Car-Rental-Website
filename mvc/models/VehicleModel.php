<?php
class VehicleModel extends Database {

    public function createVehicle($make, $model, $year, $licensePlate, $color, $mileage, $vin, $vehicleType, $status) {
        $sql = "INSERT INTO Vehicles (Make, Model, Year, LicensePlateNumber, Color, Mileage, VIN, VehicleType, Status, Is_Delete) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$make, $model, $year, $licensePlate, $color, $mileage, $vin, $vehicleType, $status]);
    }

    public function getVehicleById($vehicleId) {
        $sql = "SELECT * FROM Vehicles WHERE VehiclesID = ? AND Is_Delete = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllVehicles() {
        $sql = "SELECT * FROM Vehicles WHERE Is_Delete = 0";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateVehicle($vehicleId, $make, $model, $year, $licensePlate, $color, $mileage, $vin, $vehicleType, $status) {
        $sql = "UPDATE Vehicles SET Make = ?, Model = ?, Year = ?, LicensePlateNumber = ?, Color = ?, Mileage = ?, VIN = ?, VehicleType = ?, Status = ? 
                WHERE VehiclesID = ? AND Is_Delete = 0";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$make, $model, $year, $licensePlate, $color, $mileage, $vin, $vehicleType, $status, $vehicleId]);
    }

    public function deleteVehicle($vehicleId) {
        $sql = "UPDATE Vehicles SET Is_Delete = 1 WHERE VehiclesID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$vehicleId]);
    }
}

?>