<?php
class VehicleModel extends Database {

    public function createVehicle($data) {
        $query = "INSERT INTO Vehicles (MakeID, ModelID, Seats, VehicleTypesID, HourlyPrice, DailyPrice, WeeklyPrice, MonthlyPrice, Quantity, Description, Status, Is_Feature, PromotionID, Is_Delete) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, 'iiiiiiiiiisiii', 
            $data['MakeID'], $data['ModelID'], $data['Seats'], $data['VehicleTypesID'], 
            $data['HourlyPrice'], $data['DailyPrice'], $data['WeeklyPrice'], $data['MonthlyPrice'], 
            $data['Quantity'], $data['Description'], $data['Status'], $data['Is_Feature'], $data['PromotionID']
        );
        return mysqli_stmt_execute($stmt);
    }

    public function updateVehicle($id, $data) {
        $query = "UPDATE Vehicles SET MakeID = ?, ModelID = ?, Seats = ?, VehicleTypesID = ?, HourlyPrice = ?, DailyPrice = ?, WeeklyPrice = ?, MonthlyPrice = ?, Quantity = ?, Description = ?, Status = ?, Is_Feature = ?, PromotionID = ? WHERE VehicleID = ? AND Is_Delete = 0";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, 'iiiiiiiiiisiiii', 
            $data['MakeID'], $data['ModelID'], $data['Seats'], $data['VehicleTypesID'], 
            $data['HourlyPrice'], $data['DailyPrice'], $data['WeeklyPrice'], $data['MonthlyPrice'], 
            $data['Quantity'], $data['Description'], $data['Status'], $data['Is_Feature'], $data['PromotionID'], 
            $id
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getAllVehicles() {
        $query = "SELECT * FROM Vehicles WHERE Is_Delete = 0";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getVehicleById($id) {
        $query = "SELECT * FROM Vehicles WHERE VehicleID = ? AND Is_Delete = 0";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function getQuery($filter, $input, $args = []) {
        $baseQuery = "SELECT * FROM Vehicles WHERE Is_Delete = 0";

        if (!empty($filter) && !empty($input)) {
            $baseQuery .= " AND $filter LIKE '%" . mysqli_real_escape_string($this->con, $input) . "%'";
        }

        if (!empty($args['sort'])) {
            $baseQuery .= " ORDER BY " . mysqli_real_escape_string($this->con, $args['sort']);
            if (!empty($args['order']) && in_array(strtoupper($args['order']), ['ASC', 'DESC'])) {
                $baseQuery .= " " . strtoupper($args['order']);
            }
        }

        return $baseQuery;
    }
}

?>