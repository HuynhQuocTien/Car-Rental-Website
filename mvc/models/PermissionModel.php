<?php


class PermissionModel extends Database {

    public function createPermission($permissionName, $description) {
        $sql = "INSERT INTO Permissions (PermissionName, Description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$permissionName, $description]);
    }

    public function getPermissionById($permissionId) {
        $sql = "SELECT * FROM Permissions WHERE PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$permissionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPermissions() {
        $sql = "SELECT * FROM Permissions";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePermission($permissionId, $permissionName, $description) {
        $sql = "UPDATE Permissions SET PermissionName = ?, Description = ? WHERE PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$permissionName, $description, $permissionId]);
    }

    public function deletePermission($permissionId) {
        $sql = "DELETE FROM Permissions WHERE PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$permissionId]);
    }
}

?>
