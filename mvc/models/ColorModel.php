<?php
class ColorModel extends Database {
    public function getAll()
    {
        $sql = "SELECT * FROM Colors";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function create($colorName)
    {
        $valid = true;
        $sql = "INSERT INTO `Colors`(`ColorName`) VALUES ('$colorName')";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function update($id, $colorName)
    {
        $valid = true;
        $sql = "UPDATE `Colors` SET `ColorName`='$colorName' WHERE `ColorID` = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function delete($name)
    {
        $valid = true;
        $sql = "DELETE FROM `Colors` WHERE `ColorName` = '$name'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function getQuery($filter, $input, $args,$lastURL)
    {
        if($lastURL === "colors") {
            $lastURL = "Colors";
        }
        $query = "SELECT * FROM $lastURL ";
        if ($input) {
            $query = $query . "WHERE (ColorName LIKE N'%{$input}%' OR ColorID LIKE '%{$input}%')";
        }
        $query = $query . " ORDER BY ColorID ASC";
        return $query;
    }


}
?>