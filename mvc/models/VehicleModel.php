<?php
class VehicleModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getById($id){
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0 AND VehicleID = '$id'";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function update($vehicleID, $data)
    {
        $valid = true;
        $sql = "UPDATE Vehicles SET 
                MakeID = '{$data['makeID']}',
                ModelID = '{$data['modelID']}',
                VehicleTypesID = '{$data['vehicleTypeID']}',
                Seats = '{$data['seats']}',
                HourlyPrice = '{$data['hourlyPrice']}',
                DailyPrice = '{$data['dailyPrice']}',
                WeeklyPrice = '{$data['weeklyPrice']}',
                MonthlyPrice = '{$data['monthlyPrice']}',
                PromotionID = '{$data['promotionID']}',
                Active = '{$data['active']}',
                WHERE VehicleID = '$vehicleID'";
    
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    

    public function create($data)
    {
        $valid = true;
        $sql = "INSERT INTO `Vehicles` (
                `MakeID`, `ModelID`, `VehicleTypesID`, `Seats`,
                `HourlyPrice`, `DailyPrice`, `WeeklyPrice`, `MonthlyPrice`, `Quantity`,
                 `PromotionID`, `Active`
                ) VALUES (
                '{$data['makeID']}', '{$data['modelID']}', '{$data['vehicleTypeID']}', '{$data['seats']}',
                '{$data['hourlyPrice']}', '{$data['dailyPrice']}', '{$data['weeklyPrice']}', '{$data['monthlyPrice']}','0',
                 '{$data['promotionID']}', '{$data['active']}'
                )";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }

    public function delete($id)
    {
        $valid = true;
        $sql = "UPDATE Vehicles SET Is_Delete = 1 WHERE VehicleID = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }

    public function getQuery($filter, $input, $args, $lastURL)
    {
        if($lastURL === "vehicles") {
            $lastURL = "Vehicles";
        }
        
        $query = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                  FROM $lastURL v
                  JOIN Makes mk ON v.MakeID = mk.MakeID
                  JOIN Models md ON v.ModelID = md.ModelID
                  JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                  WHERE v.Is_Delete = 0";
        
        if ($input) {
            $query = $query. " AND (mk.MakeName LIKE '%{$input}%' OR 
                            md.ModelName LIKE '%{$input}%' OR 
                            vt.NameType LIKE '%{$input}%')";
        }
        if($filter){
            $query= $query ." AND (v.MakeID = '{$filter['makeID']}' OR 
                            v.ModelID = '{$filter['modelID']}' OR 
                            v.VehicleTypesID = '{$filter['vehicleTypeID']}')";
        }
        
        $query .= " ORDER BY v.VehicleID ASC";
        return $query;
    }

    // Additional methods if needed
    public function getFeaturedVehicles($limit = 5)
    {
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0 AND v.Is_Feature = 1 AND v.Active = 1
                LIMIT $limit";
        
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAvailableVehicles()
    {
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0 AND v.Active = 1";
        
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}
?>