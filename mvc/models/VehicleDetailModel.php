<?php
class VehicleDetailModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT vd.*, c.ColorName
                FROM VehicleDetails vd
                LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                WHERE vd.Is_Delete = 0";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getAllFeature()
    {
        $sql = "SELECT v.VehicleID, v.Quantity,v.PromotionID,v.Active,v.Seats,
         m.MakeName,mo.ModelName, vt.NameType ,
         vd.*, c.ColorName, vi.ImageID,  vi.ImageURL, vi.IsPrimary 
                    FROM VehicleDetails vd
                    LEFT JOIN Vehicles v ON vd.VehicleID = v.VehicleID
                    LEFT JOIN Makes m ON v.MakeID = m.MakeID
                    LEFT JOIN Models mo ON v.ModelID = mo.ModelID
                    LEFT JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                    LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                    LEFT JOIN VehicleImages vi ON vd.VehicleDetailID = vi.VehicleDetailID
                  WHERE vd.Is_Delete = 0 AND vd.Is_Feature = 1";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getById($id)
    {
        $sql = "SELECT vd.*, c.ColorName
                FROM VehicleDetails vd
                LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                WHERE vd.Is_Delete = 0 AND vd.VehicleDetailID = '$id'";
        $result = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByVehicleId($vehicleId)
    {
        $sql = "SELECT vd.*, c.ColorName
                FROM VehicleDetails vd
                LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                WHERE vd.Is_Delete = 0 AND vd.VehicleID = '$vehicleId'";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function create($data)
    {
        $valid = true;
    
        $sql = "INSERT INTO VehicleDetails (
                    VehicleID, ColorID, LicensePlateNumber, Mileage,
                    Year, Transmission, FuelType, HourlyPrice,
                    DailyPrice, WeeklyPrice, MonthlyPrice, FuelConsumption,
                    Active, Is_Delete
                ) VALUES (
                    '{$data['VehicleID']}', '{$data['ColorID']}', '{$data['LicensePlateNumber']}', '{$data['Mileage']}',
                    '{$data['Year']}', '{$data['Transmission']}', '{$data['FuelType']}', '{$data['HourlyPrice']}',
                    '{$data['DailyPrice']}', '{$data['WeeklyPrice']}', '{$data['MonthlyPrice']}', '{$data['FuelConsumption']}',
                    '{$data['Active']}', 0
                )";
    
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    
    public function update($vehicleDetailID, $data)
    {
        $valid = true;
    
        $sql = "UPDATE VehicleDetails SET 
                    VehicleID = '{$data['VehicleID']}',
                    ColorID = '{$data['ColorID']}',
                    LicensePlateNumber = '{$data['LicensePlateNumber']}',
                    Mileage = '{$data['Mileage']}',
                    Year = '{$data['Year']}',
                    Transmission = '{$data['Transmission']}',
                    FuelType = '{$data['FuelType']}',
                    HourlyPrice = '{$data['HourlyPrice']}',
                    DailyPrice = '{$data['DailyPrice']}',
                    WeeklyPrice = '{$data['WeeklyPrice']}',
                    MonthlyPrice = '{$data['MonthlyPrice']}',
                    FuelConsumption = '{$data['FuelConsumption']}',
                    Active = '{$data['Active']}'
                WHERE VehicleDetailID = '$vehicleDetailID'";
    
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }
    

    public function delete($id)
    {
        $valid = true;
        $sql = "UPDATE VehicleDetails SET Is_Delete = 1 WHERE VehicleDetailID = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }

    public function getAvailableDetails()
    {
        $sql = "SELECT vd.*, c.ColorName
                FROM VehicleDetails vd
                LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                WHERE vd.Is_Delete = 0 AND vd.Status = 1";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getVehicleDetails($id){
        $sql = "SELECT v.VehicleID, v.Quantity,v.PromotionID,v.Active,v.Seats,
         m.MakeName,mo.ModelName, vt.NameType ,
         vd.*, c.ColorName, vi.ImageID, vi.ImageID,  vi.ImageURL, vi.IsPrimary 
                    FROM VehicleDetails vd
                    LEFT JOIN Vehicles v ON vd.VehicleID = v.VehicleID
                    LEFT JOIN Makes m ON v.MakeID = m.MakeID
                    LEFT JOIN Models mo ON v.ModelID = mo.ModelID
                    LEFT JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                    LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                    LEFT JOIN VehicleImages vi ON vd.VehicleDetailID = vi.VehicleDetailID
                  WHERE vd.Is_Delete = 0 AND vd.VehicleDetailID = '$id'";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function getQuery( $filter,$input, $lastURL = 'VehicleDetails')
    {
        $query = "SELECT v.VehicleID, v.Quantity,v.PromotionID,v.Active,v.Seats,
         m.MakeName,mo.ModelName, vt.NameType ,
         vd.*, c.ColorName, vi.ImageID, vi.ImageID,  vi.ImageURL, vi.IsPrimary 
                    FROM VehicleDetails vd
                    LEFT JOIN Vehicles v ON vd.VehicleID = v.VehicleID
                    LEFT JOIN Makes m ON v.MakeID = m.MakeID
                    LEFT JOIN Models mo ON v.ModelID = mo.ModelID
                    LEFT JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                    LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                    LEFT JOIN VehicleImages vi ON vd.VehicleDetailID = vi.VehicleDetailID
                  WHERE vd.Is_Delete = 0 ";
        if ($input) {
            $query = $query. " AND (m.MakeName LIKE '%{$input}%' OR 
                            mo.ModelName LIKE '%{$input}%' OR 
                            vd.Year LIKE '%{$input}%')";
        }
        if(isset($filter) && !empty($filter)) {
            // Lọc theo ngày thuê
            if (!empty($filter['rentalDate']['from']) && !empty($filter['rentalDate']['to'])) {
                $fromDate = date('Y-m-d', strtotime($filter['rentalDate']['from']));
                $toDate = date('Y-m-d', strtotime($filter['rentalDate']['to']));
            
                $query .= " AND vd.VehicleDetailID NOT IN (
                    SELECT rod.VehicleDetailID
                    FROM RentalOrderDetails rod
                    JOIN RentalOrders ro ON rod.OrderID = ro.OrderID
                    WHERE ro.Status IN ('Approved', 'Processing') 
                    AND NOT (
                        rod.ReturnDate < '{$fromDate}' OR ro.RentalDate > '{$toDate}'
                    )
                )";
            }
            
            // Vehicle Type
            if (!empty($filter['vehicleType'])) {
                $vehicleType = intval($filter['vehicleType']);
                $query .= " AND v.VehicleTypesID = '{$vehicleType}'";
            }

            // Price Range (giá nằm trong VehicleDetails.Price)
            if (!empty($filter['price']['from']) || !empty($filter['price']['to'])) {
                $from = isset($filter['price']['from']) ? floatval($filter['price']['from']) : 0;
                $to = isset($filter['price']['to']) ? floatval($filter['price']['to']) : 1000000;
                $query .= " AND vd.DailyPrice BETWEEN {$from} AND {$to}";
            }

            // Seats
            if (!empty($filter['seats'])) {
                $seats = intval($filter['seats']);
                $query .= " AND v.Seats = {$seats}";
            }

            // Fuel Type
            if (!empty($filter['fuel'])) {
                $fuel = addslashes($filter['fuel']);
                $query .= " AND vd.FuelType = '{$fuel}'";
            }

            // Transmission
            if (!empty($filter['transmission'])) {
                $trans = addslashes($filter['transmission']);
                $query .= " AND vd.Transmission = '{$trans}'";
            }
        }
        $query .= " ORDER BY vd.VehicleDetailID ASC";
        return $query;
    }
    public function getIDMax()
    {
        $sql = "SELECT MAX(VehicleDetailID) AS MaxID FROM VehicleDetails";
        $result = mysqli_query($this->con, $sql);
        
        if (!$result) {
            // Ghi log lỗi nếu cần
            error_log("Database error: " . mysqli_error($this->con));
            return false; // hoặc return 0 tùy logic ứng dụng
        }
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return (int)$row['MaxID']; // Ép kiểu về integer
        }
        
        return 0; // Trả về 0 nếu bảng rỗng
    }
    public function checkLicensePlateNumber($licensePlateNumber, $excludeId = null)
{
    // Chuẩn hóa đầu vào (loại bỏ khoảng trắng thừa và chuyển đổi thành chữ hoa/thường nếu cần)
    $licensePlateNumber = trim($licensePlateNumber);
    
    // Tạo câu truy vấn kiểm tra
    $sql = "SELECT COUNT(*) AS count 
            FROM VehicleDetails 
            WHERE LicensePlateNumber = ? AND Is_Delete = 0";
    
    // Nếu có ID cần loại trừ (trường hợp update)
    if ($excludeId !== null) {
        $sql .= " AND VehicleDetailID != ?";
    }
    
    // Sử dụng prepared statement để tránh SQL injection
    $stmt = mysqli_prepare($this->con, $sql);
    if (!$stmt) {
        return false; // hoặc throw exception tùy theo thiết kế hệ thống
    }
    
    // Bind parameters
    if ($excludeId !== null) {
        mysqli_stmt_bind_param($stmt, "si", $licensePlateNumber, $excludeId);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $licensePlateNumber);
    }
    
    // Thực thi truy vấn
    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return false; // hoặc throw exception
    }
    
    // Lấy kết quả
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    return $row['count'] == 0; // Trả về true nếu biển số chưa tồn tại, false nếu đã tồn tại
}
    
}
?>