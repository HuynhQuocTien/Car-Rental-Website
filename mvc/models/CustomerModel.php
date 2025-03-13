<?php
class CustomerModel extends Database {

    // Create a new customer
    public function createCustomer($fullName, $phoneNumber, $identityCard, $avatar, $accountId, $status,$is_delete) {
        $sql = "INSERT INTO Customers (FullName, PhoneNumber, IdentityCard, Avatar, AccountID, Status, Is_Delete) 
                VALUES (?, ?, ?, ?, ?, ?,?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$fullName, $phoneNumber, $identityCard, $avatar, $accountId, $status,$is_delete]);
    }

    // Get a customer by ID
    public function getCustomerById($customerId) {
        $sql = "SELECT * FROM Customers WHERE CustomerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$customerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all customers
    public function getAllCustomers() {
        $sql = "SELECT * FROM Customers";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update customer information
    public function updateCustomer($customerId, $fullName, $phoneNumber, $identityCard, $avatar, $accountId, $status,$is_delete) {
        $sql = "UPDATE Customers SET FullName = ?, PhoneNumber = ?, IdentityCard = ?, Avatar = ?, AccountID = ?, Status = ?, Is_Delete = ? 
                WHERE CustomerID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$fullName, $phoneNumber, $identityCard, $avatar, $accountId, $status, $customerId,$is_delete]);
    }

    // Delete a customer
    public function deleteCustomer($customerId) {
        $sql = "UPDATE Customers SET Is_Delete = 1 WHERE CustomerID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$customerId]);
    }
}

?>
