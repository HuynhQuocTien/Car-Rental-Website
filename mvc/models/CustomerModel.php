<?php
class CustomerModel extends Database {

    public function exists($column, $value)
    {
        $query = "SELECT COUNT(*) AS count FROM Customers WHERE $column = '$value'";
        $stmt = mysqli_query($this->con, $query);
    
        if ($stmt) {
            $row = $stmt->fetch_assoc();  
            return $row['count'] > 0;
        } else {
            return false;
        }
    }

    public function getMaxCustomerID() {
        $sql = "SELECT MAX(CustomerID) AS maxCustomerID FROM Customers";
        $stmt = $this->con->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['maxCustomerID'];
    }

    public function create($fullName, $phoneNumber, $dateOfBirth, $identityCard, $idCardBefore, $idCardAfter, $sex, $accountID, $totalOrdered, $totalFine, $totalAmount) {
        $sql = "INSERT INTO `Customers` (`FullName`, `PhoneNumber`, `DateOfBirth`, `IdentityCard`, `IDCardBefore`, `IDCardAfter`, `Sex`, `AccountID`, `TotalOrdered`, `TotalFine`, `TotalAmount`, `Active`, `Is_Delete`) 
                VALUES ('$fullName', '$phoneNumber', '$dateOfBirth', '$identityCard', '$idCardBefore', '$idCardAfter', '$sex', '$accountID', '$totalOrdered', '$totalFine', '$totalAmount', 1, 0)";
        
        $check = true;
        $result = mysqli_query($this->con, $sql);
        
        if (!$result) {
            $check = false;
        }
        
        return $check;
    }
    
}

?>
