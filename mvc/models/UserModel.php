<?php

class UserModel extends Database {

    public function addUser($fullName, $avatar, $accountId, $active = 1, $isDelete = 0) {
        $sql = "INSERT INTO Users (FullName, Avatar, AccountID, Active, Is_Delete) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$fullName, $avatar, $accountId, $active, $isDelete]);
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM Users WHERE UserID = ? AND Is_Delete = 0";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM Users WHERE Is_Delete = 0";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $fullName, $avatar, $active) {
        $sql = "UPDATE Users SET FullName = ?, Avatar = ?, Active = ? WHERE UserID = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$fullName, $avatar, $active, $userId]);
    }

    public function softDeleteUser($userId) {
        $sql = "UPDATE Users SET Is_Delete = 1 WHERE UserID = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$userId]);
    }

    public function restoreUser($userId) {
        $sql = "UPDATE Users SET Is_Delete = 0 WHERE UserID = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$userId]);
    }
}

?>