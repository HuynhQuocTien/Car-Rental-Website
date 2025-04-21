<?php


class RoleModel extends Database {
    public function __construct() {
        parent::__construct();
    }
    public function create($name,$data){
        $sql = "INSERT INTO Roles(RoleName) VALUES ('$name')";
        $result = mysqli_query($this->con, $sql);
        if($result){
            $roleID = mysqli_insert_id($this->con);            
            foreach($data as $item){
                $funcID = $item['functionID'];
                $permissionID = $item['permissionID'];
                $sql = "INSERT INTO `RolePermissions` (`RoleID`,`FunctionID`,`PermissionID`) 
                VALUES ($roleID, $funcID, $permissionID)";
                $result = mysqli_query($this->con, $sql);
                if(!$result) return false;
            }
            return true;
        }else return false;
    }
    public function update($roleID,$name,$data){
        $sql = "UPDATE `Roles` SET `RoleName` = '$name' WHERE `RoleID` = $roleID";
        $result = mysqli_query($this->con, $sql);
        if($result){
            $sql = "DELETE FROM `RolePermissions` WHERE `RoleID` = $roleID";
            foreach($data as $item){
                $funcID = $item['functionID'];
                $permissionID = $item['permissionID'];
                $sql = "INSERT INTO `RolePermissions` (`RoleID`, `FunctionID`, `PermissionID`) VALUES ($roleID, $funcID, $permissionID)";
                $result = mysqli_query($this->con, $sql);
                if(!$result) return false;
            }
            return true;
        } else
            return false;
    }
    public function delete($roleID){
        $sql = "UPDATE `Roles` SET `Is_Delete`= 1 WHERE `RoleID` = $roleID";
        $result = mysqli_query($this->con, $sql);
        if($result){
            return true;
        }
        return false;
    }
    public function get($roleID){
        $sql = "SELECT * FROM Roles WHERE RoleID = $roleID AND Is_Delete = 0";
        $result = mysqli_query($this->con, $sql);
        if($result){
            return mysqli_fetch_assoc($result);
        }
        return false;
    }
    public function getPermissions($roleID){
        $sql = "SELECT rp.PermissionID, rp.FunctionID FROM RolePermissions rp
        WHERE rp.RoleID = $roleID";
        $result = mysqli_query($this->con, $sql);
        if($result){
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return false;
    }
    public function getQuery($filter, $input, $args, $lastURL){
        $sql = "SELECT r.RoleID, r.RoleName, COUNT(a.AccountID) AS Quantity FROM Roles  r
        LEFT JOIN Accounts a ON r.RoleID = a.RoleID
        WHERE r.Is_Delete = 0 AND r.RoleID != 0";
        if($input){
            $sql .= " AND (r.RoleName LIKE '%{$input}%')";
        }
        $sql.= " GROUP BY r.RoleID, r.RoleName";
        return $sql;
    }


}

?>
