<?php
    class OrderDetailModel extends Database {
    
        public function __construct() {
            parent::__construct();
        }

        public function getQuery($filter, $input, $args, $lastURL)
        {
            if (!isset($filter['id']) || !$filter['id']) {
                return json_encode([
                    "success" => false,
                    "message" => "Missing order id"
                ]);
            }
        
            $id = (int)$filter['id'];
        
            $query = "SELECT o.*, MakeName, ColorName, ModelName, NameType, LicensePlateNumber 
                      FROM `RentalOrderDetails` o 
                      LEFT JOIN `VehicleDetails` vd ON vd.VehicleDetailID = o.VehicleDetailID
                      LEFT JOIN `Vehicles` v ON vd.VehicleID = v.VehicleID
                      LEFT JOIN `Colors` c ON c.ColorID = vd.ColorID
                      LEFT JOIN `Makes` m ON m.MakeID = v.MakeID
                      LEFT JOIN `Models` mo ON mo.ModelID = v.ModelID 
                      LEFT JOIN `VehicleTypes` vt ON vt.VehicleTypesID = v.VehicleTypesID
                      WHERE o.OrderID = $id";
        
            return $query;
        } 
    }

?>