<?php

require_once 'Database.php';

class AddressModel extends Database {

    // Create a new address
    public function createAddress($customerId, $address, $ward, $district, $province) {
        $sql = "INSERT INTO Address (CustomerID, Address, Ward, District, Province) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$customerId, $address, $ward, $district, $province]);
    }

    // Get an address by ID
    public function getAddressById($addressId) {
        $sql = "SELECT * FROM Address WHERE AddressID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$addressId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get addresses by customer ID
    public function getAddressesByCustomer($customerId) {
        $sql = "SELECT * FROM Address WHERE CustomerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$customerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update an address
    public function updateAddress($addressId, $address, $ward, $district, $province) {
        $sql = "UPDATE Address SET Address = ?, Ward = ?, District = ?, Province = ? 
                WHERE AddressID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$address, $ward, $district, $province, $addressId]);
    }

    // Delete an address
    public function deleteAddress($addressId) {
        $sql = "DELETE FROM Address WHERE AddressID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$addressId]);
    }
}

?>