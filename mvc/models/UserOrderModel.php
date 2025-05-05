<?php
    class UserOrderModel extends Database{
        public function __construct(){
            parent::__construct();
            
        }
        public function  getQuery($filter, $input, $args, $lastURL){
            
            $id = intval($filter['id']);
            $query = "SELECT o.*, c.FullName, pm.PaymentMethod 
                    FROM `RentalOrders` o
                    LEFT JOIN `Customers` c ON o.CustomerID = c.CustomerID
                    LEFT JOIN `Payments` pm ON o.PaymentID = pm.PaymentID
                    WHERE o.CustomerID =" . $id . " AND o.Status != -2";
            return $query;
        }

        public function getCustomerIDbyToken($token) {
            $query = "SELECT `CustomerID` FROM Accounts a
                LEFT JOIN `Customers` c ON a.AccountID = c.AccountID
                WHERE a.Token = ? LIMIT 1";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc()['CustomerID'];
        }
    }

?>