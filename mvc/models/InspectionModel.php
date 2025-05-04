<?php


class InspectionModel extends Database {

    public function createInspection($rentalOrderDetailId, $inspectionDate, $conditionBefore, $conditionAfter, $damageId, $userId, $totalFineAmount, $conditionId) {
        $sql = "INSERT INTO Inspections (RentalOrderDetailID, InspectionDate, ConditionBefore, ConditionAfter, DamageID, UserID, TotalFineAmount, ConditonID) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$rentalOrderDetailId, $inspectionDate, $conditionBefore, $conditionAfter, $damageId, $userId, $totalFineAmount, $conditionId]);
    }
    public function getInspectionById($inspectionId) {
        $sql = "SELECT * FROM Inspections WHERE InspectionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$inspectionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInspectionsByOrder($rentalOrderDetailId) {
        $sql = "SELECT * FROM Inspections WHERE RentalOrderDetailID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$rentalOrderDetailId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateInspection($inspectionId, $conditionBefore, $conditionAfter, $damageId, $totalFineAmount, $conditionId) {
        $sql = "UPDATE Inspections SET ConditionBefore = ?, ConditionAfter = ?, DamageID = ?, TotalFineAmount = ?, ConditonID = ? 
                WHERE InspectionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$conditionBefore, $conditionAfter, $damageId, $totalFineAmount, $conditionId, $inspectionId]);
    }

    public function deleteInspection($inspectionId) {
        $sql = "DELETE FROM Inspections WHERE InspectionID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$inspectionId]);
    }

    // public function getQuery($filter = [], $input = '', $args = [], $lastURL = '') {
    //     $query = "SELECT ro.OrderID, rod.VehicleDetailID, mk.MakeName, m.ModelName, c.ColorName, vt.NameType, vd.DailyPrice, rod.Status
    //               FROM RentalOrders ro
    //               LEFT JOIN RentalOrderDetails rod ON ro.OrderID = rod.OrderID
    //               JOIN VehicleDetails vd ON vd.VehicleDetailID = rod.VehicleDetailID
    //               JOIN Vehicles v ON v.VehicleID = vd.VehicleID
    //               JOIN Models m ON m.ModelID = v.ModelID
    //               JOIN Makes mk ON mk.MakeID = v.MakeID
    //               JOIN Colors c ON c.ColorID = vd.ColorID
    //               JOIN VehicleTypes vt ON vt.VehicleTypesID = v.VehicleTypesID
    //               WHERE 1
    //               ORDER BY ro.OrderID
    //               "; // Điều kiện mặc định để dễ dàng nối thêm điều kiện khác
    
    //     // Tìm kiếm từ khóa (input)
    //     if (!empty($input)) {
    //         $query .= " AND (mk.MakeName LIKE '%$input%' OR m.ModelName LIKE '%$input%')";
    //     }
    
    //     // Bộ lọc filter
    //     if (!empty($filter["vehicleTypeID"])) {
    //         $query .= " AND vt.VehicleTypesID = '{$filter['vehicleTypeID']}'";
    //     }
    //     if (!empty($filter["colorID"])) {
    //         $query .= " AND c.ColorID = '{$filter['colorID']}'";
    //     }
    //     if (!empty($filter["makeID"])) {
    //         $query .= " AND mk.MakeID = '{$filter['makeID']}'";
    //     }
    
    //     if (!empty($filter["priceRange"])) {
    //         list($minPrice, $maxPrice) = explode(":", $filter["priceRange"]);
    //         $query .= " AND vd.DailyPrice BETWEEN {$minPrice} AND {$maxPrice}";
    //     }
    

    //     // Xóa phần sắp xếp
    //     // không cần phần ORDER BY nữa
    //     echo ($query);
    //     return $query;
    // }
    
    public function getQuery($filter = [], $input = ''){
        $query = "SELECT * FROM RentalOrders WHERE Status = 1"; // Mặc định để dễ nối điều kiện

        // Tìm kiếm theo địa chỉ
        if (!empty($input)) {
            $query .= " AND Address LIKE '%$input%'";
        }

        // Lọc theo khoảng tiền TotalAmount
        if (!empty($filter["totalAmountRange"])) {
            list($minAmount, $maxAmount) = explode(":", $filter["totalAmountRange"]);
            $query .= " AND TotalAmount BETWEEN {$minAmount} AND {$maxAmount}";
        }

        // echo để debug nếu cần
        // echo($query);
        return $query;
    }
}

?>