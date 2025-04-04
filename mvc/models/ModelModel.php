<?php
class ModelModel extends Database {

    public function __construct() {
        parent::__construct();
    }
    public function getAll()
    {
        $sql = "SELECT *
                    FROM Models m
                    JOIN Makes mk ON m.MakeID = mk.MakeID
                    JOIN VehicleTypes vt ON m.VehicleTypesID = vt.VehicleTypesID
                    WHERE m.Is_Delete = 0;";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function update($id, $name,$makeId,$vehicleType)
    {

        $valid = true;
        $sql = "UPDATE `Models` SET `ModelName`='$name', `MakeID`='$makeId', `VehicleTypesID`='$vehicleType' WHERE `ModelID` = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function create($name,$makeId,$vehicleType)
    {

        $valid = true;
        $sql = "INSERT INTO `Models`(`ModelName`, `MakeID`, `VehicleTypesID`) VALUES ('$name','$makeId','$vehicleType')";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }    public function delete($id)
    {
        $valid = true;
        $sql = "UPDATE `Models` SET `Is_Delete` = 1 WHERE `ModelID` = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function getQuery($filter, $input, $args,$lastURL)
    {
        if($lastURL === "models") {
            $lastURL = "Models";
        }
        $query = "SELECT * FROM $lastURL m JOIN Makes mk ON m.MakeID = mk.MakeID
                    JOIN VehicleTypes vt ON m.VehicleTypesID = vt.VehicleTypesID
                    WHERE m.Is_Delete = 0";
        if ($input) {
            $query = $query . " AND (ModelName LIKE N'%{$input}%')";
        }
        $query = $query . " ORDER BY ModelID ASC";
        return $query;
    }

}
?>