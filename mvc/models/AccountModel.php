<?php
class AccountModel extends Database
{

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
    public function updateToken($username, $token)
    {
        $valid = true;
        $sql = "UPDATE `Accounts` SET `Token`='$token' WHERE `Username` = '$username'";
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
        } else if ($user['RoleID'] != 0 && $web == "user") {
            return json_encode(["message" => "Không có quyền hạn để truy cập", "valid" => "false"]);
        } else if ($user["RoleID"] == 0 && $web == "admin") {
            return json_encode(["message" => "Không có quyền hạn để truy cập", "valid" => "false"]);
        } else if ($user['Active'] == 0) {
            return json_encode(["message" => "Tài khoản bị khóa !", "valid" => "false"]);
        } else {
            $result = password_verify($password, $user['Password']);
            if ($result) {
                $token = time() . password_hash($username, PASSWORD_DEFAULT);
                $resultToken = $this->updateToken($username, $token);
                if ($resultToken) {
                    setcookie("token", $token, time() + 7 * 24 * 3600, "/");
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
        $sql = "SELECT *  FROM `Accounts` WHERE `Token` = '$token'";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['AccountID'] = $row['AccountID'];
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
            $_SESSION['RoleID'] = $row['RoleID'];
            $_SESSION['Role'] = $this->getRole($row['RoleID']);
            return true;
        }
        return false;
    }
    public function getRole($roleId)
    {
        $sql = "SELECT rp.RoleID, f.FunctionName, p.PermissionName, p.Description AS PermissionDescription
                FROM 
                    RolePermissions rp
                JOIN 
                    Functions f ON rp.FunctionID = f.FunctionID
                JOIN 
                    Permissions p ON rp.PermissionID = p.PermissionID
                WHERE 
                    rp.RoleID = $roleId
                ORDER BY 
                    f.FunctionName, p.PermissionName;";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        $roles = array();
        foreach ($rows as $item) {
            $function = $item['FunctionName']; //Chức năng
            $permission = $item['PermissionName']; //hành động được làm
            if (!isset($roles[$function])) {
                $roles[$function] = array($permission);
            } else {
                array_push($roles[$function], $permission);
            }
        }
        return $roles;
    }

}

?>