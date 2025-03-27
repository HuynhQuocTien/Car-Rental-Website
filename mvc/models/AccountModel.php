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
    public function createAccount($username, $password, $email, $roleId) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Accounts (Username, Password, Email, RoleID) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$username, $hashedPassword, $email, $roleId]);
    }

    public function getAccountById($accountId) {
        $sql = "SELECT * FROM Accounts WHERE AccountID = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$accountId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAccountByUsername($username) {
        $sql = "SELECT * FROM Accounts WHERE Username = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAccount($accountId, $username, $email, $roleId) {
        $sql = "UPDATE Accounts SET Username = ?, Email = ?, RoleID = ? WHERE AccountID = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$username, $email, $roleId, $accountId]);
    }

    public function updatePassword($accountId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE Accounts SET Password = ? WHERE AccountID = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$hashedPassword, $accountId]);
    }

    public function deleteAccount($accountId) {
        $sql = "DELETE FROM Accounts WHERE AccountID = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$accountId]);
    }

    // Verify login credentials
    public function verifyLogin($username, $password) {
        $account = $this->getAccountByUsername($username);
        if ($account && password_verify($password, $account['Password'])) {
            return $account;
        }
        return false;
    }
    public function validateToken($token)
    {
        $sql = "SELECT * FROM `Accounts` WHERE `Token` = '$token'";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['AccountID'] = $row['AccountID'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
            return true;
        }
        return false;
    }
}

?>