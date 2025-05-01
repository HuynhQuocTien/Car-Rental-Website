<?php


class DamageTypeModel extends Database {
    public function getAll()
    {
        $sql = "SELECT * FROM DamageTypes WHERE Is_Delete = 0";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function create($data)
    {
        $valid = true;
        $sql = "INSERT INTO `DamageTypes`(`DamageName`,`FineAmount`,`VehicleTypesID`) VALUES ('$data[DamageName]','$data[FineAmount]','$data[VehicleTypesID]')";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function update($data)
    {
        $valid = true;
        $sql = "UPDATE `DamageTypes` SET 
                    `DamageName`='$data[DamageName]',
                    `FineAmount`='$data[FineAmount]',
                    `VehicleTypesID`='$data[VehicleTypesID]'
                WHERE `DamageTypeID` = '$data[DamageTypeID]'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function delete($id)
    {
        $valid = true;
        $sql = "UPDATE `DamageTypes` SET `Is_Delete` = 1 WHERE `DamageTypeID` = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function getQuery($filter, $input, $args,$lastURL)
    {
        if($lastURL === "damagetypes") {
            $lastURL = "DamageTypes";
        }
        $query = "SELECT * FROM DamageTypes 
            LEFT JOIN VehicleTypes ON DamageTypes.VehicleTypesID = VehicleTypes.VehicleTypesID
         WHERE DamageTypes.Is_Delete = 0 AND DamageTypeID != 0 ";
        if ($input) {
            $query = $query . "AND (DamageName LIKE N'%{$input}%' OR DamageTypeID LIKE '%{$input}%')";
        }
        $query = $query . " ORDER BY DamageTypeID ASC";
        return $query;
    }

    public function get($id){
        $sql = "SELECT * FROM `DamageTypes` WHERE `DamageTypeID` = $id";
        $result = mysqli_query($this->con,$sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

?>
