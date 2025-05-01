<?php
class CustomerModel extends Database {

    public function exists($column, $value)
    {
        $query = "SELECT COUNT(*) AS count FROM Customers WHERE $column = '$value'";
        $stmt = mysqli_query($this->con, $query);
    
        if ($stmt) {
            $row = $stmt->fetch_assoc();  
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    public function getByAccountID($accountID){
        $sql = "SELECT * FROM `Customers` WHERE `AccountID` = '$accountID'";
        $result = mysqli_query($this->con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row;  // Trả về một dòng duy nhất
        }
        return null; 
    }
    public function getMaxCustomerID() {
        $sql = "SELECT MAX(CustomerID) AS maxCustomerID FROM Customers";
        $stmt = $this->con->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['maxCustomerID'];
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
        VALUES ('{$data['Username']}', '{$data['Password']}', '{$data['Email']}', 0, {$data['AccountActive']}, '{$data['ProfilePicture']}')";
        $result = mysqli_query($this->con, $sql);
        $accID = mysqli_insert_id($this->con);
        if( $result) {
            $sql = "INSERT INTO `Customers` (`FullName`, `PhoneNumber`, `DateOfBirth`, `IdentityCard`, `IDCardBefore`, `IDCardAfter`, `Sex`, `AccountID`, `TotalOrdered`, `TotalFine`, `TotalAmount`, `Active`) 
            VALUES ('{$data['FullName']}','{$data['PhoneNumber']}', '{$data['DateOfBirth']}', '{$data['IdentityCard']}', '{$data['IDCardBefore']}', '{$data['IDCardAfter']}', '{$data['Sex']}', '$accID', 0, 0, 0, '{$data['CustomerActive']}')";
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
            Active = {$data['AccountActive']},
            ProfilePicture = '{$data['ProfilePicture']}'";    
$sql .= " WHERE AccountID = {$data['AccountID']}";
    
        $result = mysqli_query($this->con, $sql);
    
        if ($result) {
            // Cập nhật bảng Users
            $sql = "UPDATE Customers 
                    SET 
                        FullName = '{$data['FullName']}',
                        PhoneNumber = '{$data['PhoneNumber']}',
                        DateOfBirth = '{$data['DateOfBirth']}',
                        IdentityCard = '{$data['IdentityCard']}',
                        IDCardBefore = '{$data['IDCardBefore']}',
                        IDCardAfter = '{$data['IDCardAfter']}',
                        Sex = {$data['Sex']},
                        AccountID = {$data['AccountID']},
                        TotalOrdered = {$data['TotalOrdered']},
                        TotalFine = {$data['TotalFine']},
                        TotalAmount = {$data['TotalAmount']},
                        Active = {$data['CustomerActive']}
                    WHERE CustomerID = {$data['CustomerID']};"; // `AccountID` là khóa ngoại trong bảng Users
    
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
                    LEFT JOIN Customers c ON a.AccountID = c.AccountID
                 WHERE CustomerID = {$id} AND c.Is_Delete = 0";
        $result = mysqli_query($this->con, $sql);
        if (!$result) return false;
        return mysqli_fetch_assoc($result);
    }    
    public function getQuery($filter, $input, $args, $lastURL)
    {
        $query = "SELECT * FROM Accounts a
                    LEFT JOIN Roles r ON a.RoleID = r.RoleID
                    LEFT JOIN Customers c ON a.AccountID = c.AccountID
                    WHERE a.Is_Delete = 0 AND c.Is_Delete = 0 AND a.RoleID = 0";
        if ($input) {
            $query = $query . " AND (c.FullName LIKE '%{$input}%' OR c.IdentityCard LIKE '%{$input}%')";
        }
        $query = $query . " ORDER BY c.CustomerID ASC";
        return $query;
    }   

    
    public function updateByAccountID($accountID, $name, $phone, $birth, $idCard, $sex){
    // Kiểm tra dữ liệu đầu vào
    if (empty($accountID)) {
        return [
            "success" => false,
            "message" => "AccountID không hợp lệ"
        ];
    }
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
        $sql = "UPDATE `Customers` SET `FullName` = ?, `PhoneNumber` = ?, `DateOfBirth` = ?, `IdentityCard` = ?, `Sex` = ? WHERE `AccountID` = ?";

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
                    "message" => "Cập nhật thông tin khách hàng thành công"
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