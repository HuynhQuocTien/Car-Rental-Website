<?php
class AccountModel extends Database
{

    public function getDataByDateRange($startDate, $endDate)
    {
        $query = "SELECT * FROM `Accounts` 
                WHERE `CreatedAt` BETWEEN '$startDate' AND '$endDate'";
    
        $stmt = mysqli_query($this->con, $query);
    
        if ($stmt) {
            $results = [];
            while ($row = mysqli_fetch_assoc($stmt)) { // đổi thành mysqli_fetch_assoc
                $results[] = $row;
            }
            return $results;
        } else {
            return false;
        }
    }
    


    public function exists($column, $value)
    {
        $query = "SELECT COUNT(*) AS count FROM Accounts WHERE $column = '$value';";
        $stmt = mysqli_query($this->con, $query);

        if ($stmt) {
            $row = $stmt->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    public function getMaxAccountID()
    {
        $sql = "SELECT MAX(AccountID) AS maxAccountID FROM `Accounts`";
        $result = mysqli_query($this->con, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['maxAccountID'];
        } else {
            return false; // Nếu có lỗi xảy ra khi thực thi truy vấn
        }
    }
    public function create($username, $password, $token, $pictureAvatar, $googleID, $email, $roleId)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `Accounts` (`Username`, `Password`, `Token`, `ProfilePicture`, `GoogleID`, `Email`, `RoleID`,`Active`, `Is_Delete`) 
        VALUES ('$username', '$hashedPassword', '$token', '$pictureAvatar', '$googleID', '$email', '$roleId',1,0)";
        $check = true;
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            $check = false;
        }
        return $check;
    }
    public function getByUsername($username)
    {
        $sql = "SELECT * FROM `Accounts` WHERE `Username` = '$username' OR `Email` = '$username'";
        $result = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($result);
    }
    public function getByToken($token){
        $sql = "SELECT * FROM `Accounts` WHERE `Token` = '$token'";
        $result = mysqli_query($this->con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row;  // Trả về một dòng duy nhất
        }
        return null; 
    }
    public function updateToken($username, $token)
    {
        $valid = true;
        $sql = "UPDATE `Accounts` SET `Token`='$token' WHERE `Username` = '$username' OR `Email` = '$username'";
        $result = mysqli_query($this->con, $sql);
        if (!$result)
            $valid = false;
        return $valid;
    }
    public function checkLogin($username, $password, $web)
    {
        $user = $this->getByUsername($username);
        if ($user == '') {
            return json_encode(["message" => "Tài khoản không tồn tại !", "valid" => "false"]);
        } else if ($user['RoleID'] > 0 && $web == "user") {
            return json_encode(["message" => "Không có quyền hạn để truy cập", "valid" => "false","user" => $user]);
        } else if ($user["RoleID"] == 0 && $web == "admin") {
            return json_encode(["message" => "Không có quyền hạn để truy cập", "valid" => "false","user" => $user]);
        } else if ($user['Active'] == 0) {
            return json_encode(["message" => "Tài khoản bị khóa !", "valid" => "false","user" => $user]);
        } else {
            $result = password_verify($password, $user['Password']);
            if ($result) {
                $token = time() . password_hash($user['Username'], PASSWORD_DEFAULT);
                $resultToken = $this->updateToken($user['Username'], $token);
                if ($resultToken) {
                    setcookie("token", $token, time() + 7 * 24 * 3600, "/");
                    $this->validateToken($token);
                    return json_encode(["message" => "Đăng nhập thành công !", "valid" => "true"]);
                } else {
                    return json_encode(["message" => "Đăng nhập không thành công !", "valid" => "false"]);
                }
            } else {
                return json_encode(["message" => "Sai mật khẩu !", "valid" => "false"]);
            }
        }
    }

    public function updateOTP($email, $otp)
    {
        $valid = true;
        $sql = "UPDATE `Accounts` SET `OTP`= $otp WHERE `Email`='$email'";
        $result = mysqli_query($this->con, $sql);
        if (!$result)
            $valid = false;
        return $valid;
    }

    public function checkOTP($email, $otp)
    {
        $sql = "SELECT * FROM `Accounts` WHERE `Email` = '$email' AND `OTP` = $otp";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($email, $new_password)
    {
        $password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE `Accounts` SET `Password`='$password' WHERE `Email` = '$email'";
        $check = true;
        $result = mysqli_query($this->con, $sql);
        if (!$result)
            $check = false;
        return $check;
    }
    public function validateToken($token)
    {
        $sql = "SELECT 
        a.*,
        u.FullName AS UserFullName,
        c.FullName AS CustomerFullName,
        u.UserID, c.CustomerID,
        rl.RoleName 
        FROM `Accounts` a
        LEFT JOIN `Roles` rl ON a.RoleID = rl.RoleID
        LEFT JOIN `Users` u ON a.AccountID = u.AccountID
        LEFT JOIN `Customers` c ON a.AccountID = c.AccountID
        WHERE a.Token = '$token' AND a.Is_Delete = 0";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['AccountID'] = $row['AccountID'];
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['CreatedAt'] = $row['CreatedAt'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['FullName'] = !empty($row['UserFullName']) 
                                        ? $row['UserFullName'] 
                                        : $row['CustomerFullName'];
            $_SESSION['UserID'] = !empty($row['UserID']) ? $row['UserID'] : $row['CustomerID'];
            $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
            $_SESSION['RoleID'] = $row['RoleID'];
            $_SESSION['RoleName'] = $row['RoleName'];
            $_SESSION['Roles'] = $this->getRole($row['RoleID']);
            return true;
        }
        return false;
    }
    public function getRole($roleId)
    {
        $sql = "SELECT rp.*
                FROM 
                    RolePermissions rp
                WHERE 
                    rp.RoleID = $roleId;";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        $roles = array();
        foreach ($rows as $item) {
            $function = $item['FunctionID']; //Chức năng
            $permission = $item['PermissionID']; //hành động được làm 1: Thêm, 2: Sửa, 3: Xóa, 4: Xem, 5:Duyệt, 6: KT, 7:Báo cáo
            if (!isset($roles[$function])) {
                $roles[$function] = array($permission);
            } else {
                array_push($roles[$function], $permission);
            }
        }
        return $roles;
    }
    public function updateUserProfile($newEmail, $token) {
        $sql = "UPDATE `Accounts` SET `Email` = ? WHERE `Token` = ?";
        $stmt = mysqli_prepare($this->con, $sql);
    
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $newEmail, $token);
            if (mysqli_stmt_execute($stmt)) {
                // Trả về mảng thay vì chuỗi JSON
                return [
                    "success" => true,
                    "message" => "Cập nhật email thành công"
                ];
            } else {
                // Trả về mảng thay vì chuỗi JSON
                return [
                    "success" => false,
                    "message" => "Lỗi khi cập nhật: " . mysqli_error($this->con)
                ];
            }
        } else {
            // Trả về mảng thay vì chuỗi JSON
            return [
                "success" => false,
                "message" => "Không thể chuẩn bị truy vấn: " . mysqli_error($this->con)
            ];
        }
    }
    
    
    
    

    public function checkEmail($email,$userID)
    {
        $sql = "SELECT *  FROM Users
            JOIN Accounts ON Users.AccountID = Accounts.AccountID
        WHERE (Email = '$email' AND Users.UserID != $userID)";
        $result = mysqli_query($this->con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['Email'] ?? null;
    }
    public function checkUsername($username,$userID)
    {
        $sql = "SELECT *  FROM Users
            JOIN Accounts ON Users.AccountID = Accounts.AccountID
        WHERE (Username = '$username' AND Users.UserID != $userID)";
        $result = mysqli_query($this->con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['Username'] ?? null;
    }

}

?>