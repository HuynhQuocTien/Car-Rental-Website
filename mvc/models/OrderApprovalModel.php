<?php

class OrderApprovalModel extends Database {
    public function __construct() {
        parent::__construct();
    }
    public function getQuery($filter, $input, $args, $lastURL)
    {
        $query = "SELECT o.*, c.FullName, pm.PaymentMethod FROM `RentalOrders` o
            LEFT JOIN `Customers` c ON o.CustomerID = c.CustomerID
            LEFT JOIN `Payments` pm ON o.PaymentID = pm.PaymentID
            WHERE o.UserID IS NULL
        ";
        // if ($input) {
        //     $query = $query . " AND (p.PromotionName LIKE '%{$input}%')";
        // }
        $query = $query . " ORDER BY o.OrderID  ASC";
        return $query;
    } 
}
?>