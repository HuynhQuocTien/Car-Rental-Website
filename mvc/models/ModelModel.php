<?php
class ModelModel extends Database {

    public function __construct() {
        parent::__construct();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM Models";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

}
?>