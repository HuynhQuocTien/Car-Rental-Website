<?php
class AccountModel extends Database {

    public function exists($column, $value)
    {
        $query = "SELECT COUNT(*) AS count FROM Accounts WHERE $column = '$value'";
        $stmt = mysqli_query($this->con, $query);
    
        if ($stmt) {
            $row = $stmt->fetch_assoc();  
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    public function getMaxAccountID() {
        $sql = "SELECT MAX(AccountID) AS maxAccountID FROM `Accounts`";
        $result = mysqli_query($this->con, $sql);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['maxAccountID'];
        } else {
            return false; // Nếu có lỗi xảy ra khi thực thi truy vấn
        }
    }
    public function create($username, $password, $token, $pictureAvatar, $googleID, $email, $roleId) {
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
        $sql = "SELECT * FROM `Accounts` WHERE `Username` = '$username' OR `Email` = '$username' OR `Phone` = '$username'";
        $result = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($result);
    }
    public function updateToken($username, $token)
    {
        $valid = true;
        $sql = "UPDATE `Accounts` SET `Token`='$token' WHERE `Username` = '$username'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    public function checkLogin($username, $password) {
        $user = $this->getByUsername($username);
        if ($user == '') {
            return json_encode(["message" => "Tài khoản không tồn tại !", "valid" => "false"]);
        } else if($user['RoleID'] != 0){
            return json_encode(["message" => "Không đúng quyền hạn", "valid" => "false"]);
        } 
        else if ($user['Active'] == 0) {
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
        if (!$result) $valid = false;
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
        if (!$result) $check = false;
        return $check;
    }

}

?>