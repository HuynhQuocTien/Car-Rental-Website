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


        // INSERT INTO `RentalOrders` (`OrderID`, `CustomerID`, `UserID`, `OrderDate`, `RentalDate`, `TotalAmount`, `Address`, `PromotionID`, `Status`, `PaymentID`) 
        //VALUES ('1', NULL, '1', '2025-04-23 17:19:33', '2025-04-23 17:19:33', '100000', '271 An Duong Vuong', NULL, '1', NULL);
    }
?>