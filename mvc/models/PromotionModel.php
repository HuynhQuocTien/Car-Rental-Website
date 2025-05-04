<?php
    class PromotionModel extends Database {

        public function __construct() {
            parent::__construct();
        }

        public function getQuery($filter, $input, $args, $lastURL)
        {
            $query = "SELECT * FROM `Promotions` p WHERE Is_Delete = 0";
            if ($input) {
                $query = $query . " AND (p.PromotionName LIKE '%{$input}%')";
            }
            $query = $query . " ORDER BY p.PromotionID ASC";
            return $query;
        } 

        public function getAll() {
            $query = "SELECT * FROM `Promotions` WHERE Is_Delete = 0 ORDER BY PromotionID ASC";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        // INSERT INTO `RentalOrders` (`OrderID`, `CustomerID`, `UserID`, `OrderDate`, `RentalDate`, `TotalAmount`, `Address`, `PromotionID`, `Status`, `PaymentID`) 
        //VALUES ('1', NULL, '1', '2025-04-23 17:19:33', '2025-04-23 17:19:33', '100000', '271 An Duong Vuong', NULL, '1', NULL);
    }
?>