<?php
class MakeModel extends Database {

    public function __construct() {
        parent::__construct();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM Makes WHERE Is_Delete = 0;";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function update($id, $makeName,$country)
    {
        $valid = true;
        $sql = "UPDATE `Makes` SET `MakeName`='$makeName', `Country`='$country' WHERE `MakeID` = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function create($makeName,$country)
    {
        $valid = true;
        $sql = "INSERT INTO `Makes`(`MakeName`, `Country`) VALUES ('$makeName','$country')";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function delete($id)
    {
        $valid = true;
        $sql = "DELETE FROM `Makes` WHERE `MakeID` = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function getQuery($filter, $input, $args,$lastURL)
    {
        if($lastURL === "makes") {
            $lastURL = "Makes"; //DB table Make
        }
        $query = "SELECT * FROM $lastURL ";
        if ($input) {
            $query = $query . " WHERE (MakeName LIKE N'%{$input}%'  OR MakeID LIKE '%{$input}%' OR Country LIKE '%{$input}%')";
        } 
        $query = $query . " ORDER BY MakeID ASC";
        return $query;
    }

}
?>