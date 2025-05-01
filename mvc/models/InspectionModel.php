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

    // SELECT rod.VehicleDetailID, mk.MakeName, m.ModelName, c.ColorName, vt.NameType, vd.DailyPrice, rod.Status
    // FROM `RentalOrders` ro
    // JOIN `RentalOrderDetails` rod ON ro.OrderID = rod.OrderID
    // JOIN `VehicleDetails` vd ON vd.VehicleDetailID = rod.VehicleDetailID
    // JOIN `Vehicles` v ON v.VehicleID = vd.VehicleID
    // JOIN `Models` m ON m.ModelID = v.ModelID
    // JOIN `Makes` mk ON mk.MakeID = v.MakeID
    // JOIN `Colors` c ON c.ColorID = vd.ColorID
    // JOIN `VehicleTypes` vt ON vt.VehicleTypesID = v.VehicleTypesID

    public function getAllInspections($keyword = '', $sort = '', $group = '') {
        // Phần SELECT và JOIN cố định
        $select = "SELECT rod.VehicleDetailID, mk.MakeName, m.ModelName, c.ColorName, vt.NameType, vd.DailyPrice, rod.Status";
    
        $from = "FROM `RentalOrders` ro
            JOIN `RentalOrderDetails` rod ON ro.OrderID = rod.OrderID
            JOIN `VehicleDetails` vd ON vd.VehicleDetailID = rod.VehicleDetailID
            JOIN `Vehicles` v ON v.VehicleID = vd.VehicleID
            JOIN `Models` m ON m.ModelID = v.ModelID
            JOIN `Makes` mk ON mk.MakeID = v.MakeID
            JOIN `Colors` c ON c.ColorID = vd.ColorID
            JOIN `VehicleTypes` vt ON vt.VehicleTypesID = v.VehicleTypesID";
    
        $where = "";
        $groupBy = "";
        $orderBy = "";
    
        // Điều kiện WHERE
        if (!empty($keyword)) {
            $where = "WHERE mk.MakeName LIKE '%$keyword%' OR m.ModelName LIKE '%$keyword%'";
        }
    
        // GROUP BY
        if (!empty($group)) {
            $groupBy = "GROUP BY $group";
        }
    
        // ORDER BY
        if (!empty($sort)) {
            $orderBy = "ORDER BY $sort";
        }
    
        // Ghép tất cả lại
        $sql = "$select $from $where $groupBy $orderBy";
    
        // Thực thi
        $result = mysqli_query($this->con, $sql);
        $inspections = [];
    
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $inspections[] = $row;
            }
        }
    
        return $inspections;
    }

    public function getAllCategories(){
        $sql = "SELECT NameType FROM `VehicleTypes`"; // hoặc bảng bạn dùng
        $result = mysqli_query($this->con, $sql);
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function getAllColors(){
        $sql = "SELECT ColorName FROM `Colors`"; // hoặc bảng bạn dùng
        $result = mysqli_query($this->con, $sql);
        $colors = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $colors[] = $row;
        }
        return $colors;
    }

    public function getAllMakes(){
        $sql = "SELECT MakeName FROM `Makes`"; // hoặc bảng bạn dùng
        $result = mysqli_query($this->con, $sql);
        $makes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $makes[] = $row;
        }
        return $makes;
    }
    
}

?>