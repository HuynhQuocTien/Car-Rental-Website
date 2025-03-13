<?php

require_once 'Database.php';

class RoleModel extends Database {

    // Create a new role
    public function createRole($roleName) {
        $sql = "INSERT INTO Roles (RoleName) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleName]);
    }

    // Get a role by ID
    public function getRoleById($roleId) {
        $sql = "SELECT * FROM Roles WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$roleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all roles
    public function getAllRoles() {
        $sql = "SELECT * FROM Roles";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a role
    public function updateRole($roleId, $roleName) {
        $sql = "UPDATE Roles SET RoleName = ? WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleName, $roleId]);
    }

    // Delete a role
    public function deleteRole($roleId) {
        $sql = "DELETE FROM Roles WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$roleId]);
    }
}

?>
