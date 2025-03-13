<?php


class RoleModel extends Database {

    public function createRole($roleName) {
        $sql = "INSERT INTO Roles (RoleName) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleName]);
    }

    public function getRoleById($roleId) {
        $sql = "SELECT * FROM Roles WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$roleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllRoles() {
        $sql = "SELECT * FROM Roles";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRole($roleId, $roleName) {
        $sql = "UPDATE Roles SET RoleName = ? WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleName, $roleId]);
    }

    public function deleteRole($roleId) {
        $sql = "DELETE FROM Roles WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleId]);
    }
}

?>
