<?php

class VehicleImageModel extends Database {
    
    public function create($data)
    {
        $valid = true;
    
        $sql = "INSERT INTO VehicleImages (
                    VehicleDetailID, ImageURL, IsPrimary
                ) VALUES (
                    '{$data['VehicleDetailID']}', '{$data['ImageURL']}', '{$data['IsPrimary']}'
                )";
    
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    
    public function update($imageID, $data)
    {
        $valid = true;
    
        $sql = "UPDATE VehicleImages SET 
                    VehicleDetailID = '{$data['VehicleDetailID']}',
                    ImageURL = '{$data['ImageURL']}',
                    IsPrimary = '{$data['IsPrimary']}'
                WHERE ImageID = '$imageID'";
    
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    
    public function delete($imageID)
    {
        $valid = true;
        $sql = "DELETE FROM VehicleImages WHERE ImageID = '$imageID'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    
    public function getByVehicleDetailID($vehicleDetailID)
    {
        $sql = "SELECT * FROM VehicleImages WHERE VehicleDetailID = '$vehicleDetailID'";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    
    public function getPrimaryImage($vehicleDetailID)
    {
        $sql = "SELECT * FROM VehicleImages WHERE VehicleDetailID = '$vehicleDetailID' AND IsPrimary = 1 LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    
    public function setAsPrimary($imageID, $vehicleDetailID)
    {
        $valid = true;
        
        // First, set all images for this vehicle as not primary
        $sql1 = "UPDATE VehicleImages SET IsPrimary = 0 WHERE VehicleDetailID = '$vehicleDetailID'";
        $result1 = mysqli_query($this->con, $sql1);
        
        // Then set the selected image as primary
        $sql2 = "UPDATE VehicleImages SET IsPrimary = 1 WHERE ImageID = '$imageID'";
        $result2 = mysqli_query($this->con, $sql2);
        
        if (!$result1 || !$result2) $valid = false;
        return $valid;
    }
}

?>