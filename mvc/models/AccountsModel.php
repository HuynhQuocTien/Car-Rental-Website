<?php
class AccountModel extends Database {
    public function createAccount($username, $password, $email, $roleId) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Accounts (Username, Password, Email, RoleID) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $hashedPassword, $email, $roleId]);
    }

    public function getAccountById($accountId) {
        $sql = "SELECT * FROM Accounts WHERE AccountID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$accountId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAccountByUsername($username) {
        $sql = "SELECT * FROM Accounts WHERE Username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAccount($accountId, $username, $email, $roleId) {
        $sql = "UPDATE Accounts SET Username = ?, Email = ?, RoleID = ? WHERE AccountID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $email, $roleId, $accountId]);
    }

    public function updatePassword($accountId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE Accounts SET Password = ? WHERE AccountID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$hashedPassword, $accountId]);
    }

    public function deleteAccount($accountId) {
        $sql = "DELETE FROM Accounts WHERE AccountID = ?";
        $stmt = $this->conn->prepare($sql);
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