<?php

require_once 'Database.php';

class PermissionModel extends Database {

    // Create a new permission
    public function createPermission($permissionName, $description) {
        $sql = "INSERT INTO Permissions (PermissionName, Description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$permissionName, $description]);
    }

    // Get a permission by ID
    public function getPermissionById($permissionId) {
        $sql = "SELECT * FROM Permissions WHERE PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$permissionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all permissions
    public function getAllPermissions() {
        $sql = "SELECT * FROM Permissions";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a permission
    public function updatePermission($permissionId, $permissionName, $description) {
        $sql = "UPDATE Permissions SET PermissionName = ?, Description = ? WHERE PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$permissionName, $description, $permissionId]);
    }

    // Delete a permission
    public function deletePermission($permissionId) {
        $sql = "DELETE FROM Permissions WHERE PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$permissionId]);
    }
}

?>
