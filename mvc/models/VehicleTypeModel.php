<?php

class VehicleTypeModel extends Database {

    public function getAll()
    {
        $sql = "SELECT * FROM `VehicleTypes`";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

?>
