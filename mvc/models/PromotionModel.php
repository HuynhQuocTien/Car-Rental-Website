<?php
    class PromotionModel extends Database {

        public function __construct() {
            parent::__construct();
        }
        public function getAll()
        {
            $sql = "SELECT p.*, v.VehicleName, u.Username 
                    FROM Promotions p
                    LEFT JOIN Vehicles v ON p.VehicleID = v.VehicleID
                    LEFT JOIN Users u ON p.UserID = u.UserID
                    WHERE p.Is_Delete = 0";
            $result = mysqli_query($this->con, $sql);
            $rows = array();
            while($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
        public function exists($column, $value,$check)
        {
            $query = "SELECT COUNT(*) AS count FROM Promotions WHERE $column = '$value' AND $column != '$check';";
            $stmt = mysqli_query($this->con, $query);
    
            if ($stmt) {
                $row = $stmt->fetch_assoc();
                return $row['count'] > 0;
            } else {
                return false;
            }
        }
        
        public function create($data)
        {
            // Assuming $data contains all necessary fields
            $name = $data['PromotionName'];
            $code = $data['PromotionCode'];
            $vehicleId = isset($data['VehicleID']) && $data['VehicleID'] !== '' ? (int)$data['VehicleID'] : null;
            $discountType = $data['DiscountType'];
            $discountValue = $data['DiscountValue'];
            $userId = $data['UserID'];
            $startDate = $data['StartDate'];
            $endDate = $data['EndDate'];
            $description = $data['Description'];
            $status = $data['Status'];
            $valid = true;
            $sql = "INSERT INTO `Promotions` 
                    (`PromotionName`, `PromotionCode`, `VehicleID`, `DiscountType`, `DiscountValue`, 
                     `UserID`, `StartDate`, `EndDate`, `Description`, `Status`) 
                    VALUES 
                    ('$name', '$code', " . ($vehicleId !== null ? $vehicleId : "NULL") . ", '$discountType', '$discountValue', 
                     '$userId', '$startDate', '$endDate', '$description', '$status')";
            
            $result = mysqli_query($this->con, $sql);
            if (!$result) $valid = false;
            return $valid;
        }
        
        public function update($data)
        {
            $id = $data['PromotionID'];
            $name = $data['PromotionName'];
            $code = $data['PromotionCode'];
            $vehicleId = isset($data['VehicleID']) && $data['VehicleID'] !== '' ? (int)$data['VehicleID'] : null;
            $discountType = $data['DiscountType'];
            $discountValue = $data['DiscountValue'];
            $userId = $data['UserID'];
            $startDate = $data['StartDate'];
            $endDate = $data['EndDate'];
            $description = $data['Description'];
            $status = $data['Status'];
        
            $valid = true;
            $sql = "UPDATE `Promotions` 
                    SET `PromotionName`='$name', 
                        `PromotionCode`='$code', 
                        `VehicleID`=" . ($vehicleId !== null ? $vehicleId : "NULL") . ", 
                        `DiscountType`='$discountType', 
                        `DiscountValue`='$discountValue', 
                        `UserID`='$userId', 
                        `StartDate`='$startDate', 
                        `EndDate`='$endDate', 
                        `Description`='$description', 
                        `Status`='$status' 
                    WHERE `PromotionID` = '$id'";
            
            $result = mysqli_query($this->con, $sql);
            if (!$result) $valid = false;
            return $valid;
        }
        
        public function delete($id)
        {
            $valid = true;
            $sql = "UPDATE `Promotions` SET `Is_Delete` = 1 WHERE `PromotionID` = '$id'";
            $result = mysqli_query($this->con, $sql);
            if (!$result) $valid = false;
            return $valid;
        }


        public function getQuery($filter, $input, $args, $lastURL)
        {
            $query = "SELECT * FROM `Promotions` p WHERE Is_Delete = 0 AND p.PromotionID != 0";
            if ($input) {
                $query = $query . " AND (p.PromotionName LIKE '%{$input}%')";
            }
            $query = $query . " ORDER BY p.PromotionID ASC";
            return $query;
        } 

    }
?>