<?php

require_once 'Database.php';

class UserModel extends Database {

    // Create a new user
    public function createUser($username, $password, $fullName, $avatar, $accountId, $active) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Users (Username, Password, FullName, Avatar, AccountID, Active, Is_Delete) 
                VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $hashedPassword, $fullName, $avatar, $accountId, $active]);
    }

    // Get a user by ID
    public function getUserById($userId) {
        $sql = "SELECT * FROM Users WHERE UserID = ? AND Is_Delete = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all active users
    public function getAllUsers() {
        $sql = "SELECT * FROM Users WHERE Is_Delete = 0";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update user details
    public function updateUser($userId, $username, $fullName, $avatar, $accountId, $active) {
        $sql = "UPDATE Users SET Username = ?, FullName = ?, Avatar = ?, AccountID = ?, Active = ?
                WHERE UserID = ? AND Is_Delete = 0";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $fullName, $avatar, $accountId, $active, $userId]);
    }

    // Change user password
    public function changePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE Users SET Password = ? WHERE UserID = ? AND Is_Delete = 0";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$hashedPassword, $userId]);
    }

    // Soft delete a user
    public function deleteUser($userId) {
        $sql = "UPDATE Users SET Is_Delete = 1 WHERE UserID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId]);
    }

    // Authenticate user
    public function authenticate($username, $password) {
        $sql = "SELECT * FROM Users WHERE Username = ? AND Is_Delete = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        }
        return false;
    }
}

?>