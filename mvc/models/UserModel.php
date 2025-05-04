<?php

class UserModel extends Database {


    public function __construct() {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Users";
        $result = mysqli_query($this->con,$sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
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
        
            $accID = mysqli_insert_id($this->con);
        if ($result) {
            $sql = "INSERT INTO Users (FullName, PhoneNumber, Sex, IdentityCard, DateOfBirth, AccountID, Active) 
            VALUES ('{$data['FullName']}', '{$data['PhoneNumber']}', {$data['Sex']}, '{$data['IdentityCard']}', '{$data['DateOfBirth']}',
             {$accID}, {$data['Active']})";
            $result = mysqli_query($this->con, $sql);
            if (!$result) return false;
        } else if($accID) {
            $sql = "DELETE FROM Accounts WHERE AccountID = {$accID} ";
            $result = mysqli_query($this->con, $sql);
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
    public function delete($userID,$accId) {
        // Đánh dấu là đã xóa trong bảng Accounts
        $sql = "UPDATE Accounts SET Is_Delete = 1 WHERE AccountID = {$accId} ";
        $result = mysqli_query($this->con, $sql);
    
        if ($result) {
            // Đánh dấu là đã xóa trong bảng Users
            $sql = "UPDATE Users SET Is_Delete = 1 WHERE UserID = {$userID}";
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
    public function getByAccountID($accountID){
        $sql = "SELECT * FROM `Users` WHERE `AccountID` = '$accountID'";
        $result = mysqli_query($this->con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row;  // Trả về một dòng duy nhất
        }
        return null; 
    }

    public function updateByAccountID($accountID, $name, $phone, $birth, $idCard, $sex){
         // Kiểm tra dữ liệu đầu vào
        if (empty($accountID)) {
            return [
                "success" => false,
                "message" => "AccountID không hợp lệ"
            ];
        }

        // Chuẩn hóa định dạng ngày sinh về YYYY-MM-DD
        $birthDate = date_create($birth); // dùng date_create cho linh hoạt
            if (!$birthDate) {
                return [
                    "success" => false,
                    "message" => "Ngày sinh không hợp lệ. Định dạng phải là YYYY-MM-DD hoặc dạng tương tự."
                ];
            }
            $birthFormatted = $birthDate->format('Y-m-d');

            // Làm sạch dữ liệu đầu vào
            $name = mysqli_real_escape_string($this->con, $name);
            $phone = mysqli_real_escape_string($this->con, $phone);
            $birthFormatted = mysqli_real_escape_string($this->con, $birthFormatted);
            $idCard = mysqli_real_escape_string($this->con, $idCard);
            $sex = mysqli_real_escape_string($this->con, $sex);
            $accountID = mysqli_real_escape_string($this->con, $accountID);

            // Truy vấn SQL để cập nhật thông tin trong bảng Customers
            $sql = "UPDATE `Users` SET `FullName` = ?, `PhoneNumber` = ?, `DateOfBirth` = ?, `IdentityCard` = ?, `Sex` = ? WHERE `AccountID` = ?";

            // Log câu lệnh SQL để kiểm tra
            error_log("SQL Query: " . $sql);

            // Chuẩn bị câu lệnh SQL
            $stmt = mysqli_prepare($this->con, $sql);

            if ($stmt) {
                // Gắn các tham số vào câu lệnh SQL
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $phone, $birthFormatted, $idCard, $sex, $accountID);

                // Log giá trị các tham số để kiểm tra
                error_log("Binding parameters: name = $name, phone = $phone, birth = $birthFormatted, idCard = $idCard, sex = $sex, accountID = $accountID");

                // Thực thi câu lệnh SQL
                if (mysqli_stmt_execute($stmt)) {
                    return [
                        "success" => true,
                        "message" => "Cập nhật thông profile admin thành công"
                    ];
                } else {
                    // Log lỗi khi thực thi câu lệnh
                    error_log("SQL Error: " . mysqli_error($this->con));
                    return [
                        "success" => false,
                        "message" => "Lỗi khi cập nhật: " . mysqli_error($this->con)
                    ];
                }
            } else {
                // Log lỗi khi không thể chuẩn bị câu lệnh
                error_log("SQL Prepare Error: " . mysqli_error($this->con));
                return [
                    "success" => false,
                    "message" => "Không thể chuẩn bị truy vấn: " . mysqli_error($this->con)
                ];
            }
    }

}

?>