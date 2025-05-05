<?php

class VehicleTypeModel extends Database {

    public function getAll()
    {
        $sql = "SELECT * FROM `VehicleTypes` WHERE `Is_Delete` = 0";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function create($nameType)
    {
        $valid = true;
        $sql = "INSERT INTO `VehicleTypes`(`NameType`) VALUES ('$nameType')";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function update($id, $nameType)
    {
        $valid = true;
        $sql = "UPDATE `VehicleTypes` SET `NameType`='$nameType' WHERE `VehicleTypesID` = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function delete($nameType)
    {
        $valid = true;
        $sql = "DELETE FROM `VehicleTypes` WHERE `NameType` = '$nameType'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function getQuery($filter, $input, $args,$lastURL)
    {
        if($lastURL == "vehiclecategory") {
            $lastURL = "VehicleTypes";
        }
        $query = "SELECT * FROM $lastURL ";
        if ($input) {
            $query = $query . " WHERE (NameType LIKE N'%{$input}%' OR VehicleTypesID LIKE '%{$input}%')";
        }
        $query = $query . " ORDER BY VehicleTypesID ASC ";
        // echo $query;
        // echo $lastURL;
        return $query;
    }
    

}

?>
