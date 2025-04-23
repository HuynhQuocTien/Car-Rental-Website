<?php

class UserModel extends Database {


    public function __construct() {
        parent::__construct();
    }

    public function checkPhone($phone,$userID)
    {
        $sql = "SELECT * FROM Users WHERE (PhoneNumber = '$phone' AND UserID != $userID)";
        $result = mysqli_query($this->con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['PhoneNumber'] ?? null;
    }
    public function checkIdentityCard($IDCard,$userID)
    {
        $sql = "SELECT * FROM Users WHERE (IdentityCard = '$IDCard' AND UserID != $userID)";
        $result = mysqli_query($this->con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['IdentityCard'] ?? null;
    }
    public function create($data) {
        $sql = "INSERT INTO Accounts (Username, Password, Email, RoleID, Active, ProfilePicture) 
            VALUES ('{$data['Username']}', '{$data['Password']}', '{$data['Email']}', {$data['RoleID']}, {$data['Active']}, '{$data['ProfilePicture']}')";
            $result = mysqli_query($this->con, $sql);
        
        if ($result) {
            $accID = mysqli_insert_id($this->con);
            $sql = "INSERT INTO Users (FullName, PhoneNumber, Sex, IdentityCard, DateOfBirth, AccountID, Active) 
            VALUES ('{$data['FullName']}', '{$data['PhoneNumber']}', {$data['Sex']}, '{$data['IdentityCard']}', '{$data['DateOfBirth']}',
             {$accID}, {$data['Active']})";
            $result = mysqli_query($this->con, $sql);
            if (!$result) return false;
        } else {
            return false;
        }
        return true;
    }
    public function update($data) {
        // Cập nhật bảng Accounts
        $sql = "UPDATE Accounts 
                SET 
                    Username = '{$data['Username']}',
                    Email = '{$data['Email']}',
                    RoleID = {$data['RoleID']},
                    Active = {$data['Active']},
                    ProfilePicture = '{$data['ProfilePicture']}'";    
        $sql .= " WHERE AccountID = {$data['AccountID']}"; // `UserID` là khóa chính liên kết
    
        $result = mysqli_query($this->con, $sql);
    
        if ($result) {
            // Cập nhật bảng Users
            $sql = "UPDATE Users 
                    SET 
                        FullName = '{$data['FullName']}',
                        PhoneNumber = '{$data['PhoneNumber']}',
                        Sex = {$data['Sex']},
                        IdentityCard = '{$data['IdentityCard']}',
                        DateOfBirth = '{$data['DateOfBirth']}',
                        Active = {$data['Active']}
                    WHERE UserID = {$data['UserID']}"; // `AccountID` là khóa ngoại trong bảng Users
    
            $result = mysqli_query($this->con, $sql);
    
            if (!$result) {
                return false;
            }
        } else {
            return false;
        }
    
        return true;
    }
    
    public function delete($userID) {
        // Đánh dấu là đã xóa trong bảng Accounts
        $sql = "UPDATE Accounts SET Is_Delete = 1 WHERE AccountID = {$userID}";
        $result = mysqli_query($this->con, $sql);
    
        if ($result) {
            // Đánh dấu là đã xóa trong bảng Users
            $sql = "UPDATE Users SET Is_Delete = 1 WHERE AccountID = {$userID}";
            $result = mysqli_query($this->con, $sql);
    
            if (!$result) {
                return false; // Nếu cập nhật bảng Users thất bại
            }
        } else {
            return false; // Nếu cập nhật bảng Accounts thất bại
        }
    
        return true; // Trả về true nếu tất cả các bước đều thành công
    }
    
    
    public function get($id){
        $sql = "SELECT * FROM Accounts a
                    LEFT JOIN Roles r ON a.RoleID = r.RoleID
                    LEFT JOIN Users u ON a.AccountID = u.AccountID
                 WHERE UserID = {$id} AND u.Is_Delete = 0";
        $result = mysqli_query($this->con, $sql);
        if (!$result) return false;
        return mysqli_fetch_assoc($result);
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
}

?>