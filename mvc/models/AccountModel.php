<?php

require_once 'Database.php';

class AccountModel extends Database {

    // Create a new account
    public function createAccount($username, $password, $email, $roleId) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Accounts (Username, Password, Email, RoleID) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $hashedPassword, $email, $roleId]);
    }

    // Get an account by ID
    public function getAccountById($accountId) {
        $sql = "SELECT * FROM Accounts WHERE AccountID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$accountId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get an account by username
    public function getAccountByUsername($username) {
        $sql = "SELECT * FROM Accounts WHERE Username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update account details
    public function updateAccount($accountId, $username, $email, $roleId) {
        $sql = "UPDATE Accounts SET Username = ?, Email = ?, RoleID = ? WHERE AccountID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $email, $roleId, $accountId]);
    }

    // Update account password
    public function updatePassword($accountId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE Accounts SET Password = ? WHERE AccountID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$hashedPassword, $accountId]);
    }

    // Delete an account
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
}

?>