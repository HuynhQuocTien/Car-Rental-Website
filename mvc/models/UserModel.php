<?php

class UserModel extends Database {


    public function __construct() {
        parent::__construct();
    }

    public function getQuery($filter, $input, $args, $lastURL)
    {
        $query = "SELECT * FROM Accounts a
                    LEFT JOIN Roles r ON a.RoleID = r.RoleID
                    LEFT JOIN Users u ON a.AccountID = u.AccountID
                    WHERE a.Is_Delete = 0 AND u.Is_Delete = 0";
        if ($input) {
            $query = $query . " AND (u.FullName LIKE '%{$input}%' OR u.IdentityCard LIKE '%{$input}%')";
        }
        $query = $query . " ORDER BY u.UserID ASC";
        return $query;
    }   
    public function getByAccountID($accountID){
        $sql = "SELECT * FROM `Users` WHERE `AccountID` = '$accountID'";
        $result = mysqli_query($this->con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row;  // Trả về một dòng duy nhất
        }
        return null; 
    }
}

?>