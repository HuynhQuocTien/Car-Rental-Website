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

    }
?>