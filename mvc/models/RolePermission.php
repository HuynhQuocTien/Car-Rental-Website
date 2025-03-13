<?php
class RolePermissionModel extends Database {

    public function assignPermissionToRole($roleId, $permissionId) {
        $sql = "INSERT INTO RolePermissions (RoleID, PermissionID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleId, $permissionId]);
    }

    public function getPermissionsByRole($roleId) {
        $sql = "SELECT p.* FROM Permissions p
                JOIN RolePermissions rp ON p.PermissionID = rp.PermissionID
                WHERE rp.RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$roleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRolesByPermission($permissionId) {
        $sql = "SELECT r.* FROM Roles r
                JOIN RolePermissions rp ON r.RoleID = rp.RoleID
                WHERE rp.PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$permissionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removePermissionFromRole($roleId, $permissionId) {
        $sql = "DELETE FROM RolePermissions WHERE RoleID = ? AND PermissionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleId, $permissionId]);
    }

    public function clearPermissionsByRole($roleId) {
        $sql = "DELETE FROM RolePermissions WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleId]);
    }
}

?>
