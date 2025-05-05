<?php

use Cloudinary\Transformation\Argument\Color;

class InspectionOrderModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function getQuery($filter, $input = null, $args = [], $table = '') {
      parse_str($table, $segments);
      $orderID = isset($segments['id']) ? intval($segments['id']) : 0;
  
      $query = "SELECT rod.OrderDetailID, vd.VehicleDetailID, rod.UserID, 
                       rod.ReturnDate, rod.ActualReturnDate, 
                       c.ColorName, vt.NameType, vd.Year, m.ModelName, mk.MakeName, rod.Status
                FROM RentalOrderDetails rod
                JOIN VehicleDetails vd ON vd.VehicleDetailID = rod.VehicleDetailID
                JOIN Vehicles v ON v.VehicleID = vd.VehicleID
                JOIN Colors c ON c.ColorID = vd.ColorID
                JOIN VehicleTypes vt ON vt.VehicleTypesID = v.VehicleTypesID
                JOIN Models m ON m.ModelID = v.ModelID
                JOIN Makes mk ON mk.MakeID = v.MakeID
                WHERE rod.OrderID = {$orderID}";
  
      // Filter theo màu sắc xe
      if (!empty($filter['color'])) {
          $colorID = intval($filter['color']);
          $query .= " AND vd.ColorID = {$colorID}";
      }
  
      // Filter theo hãng xe
      if (!empty($filter['make'])) {
          $makeID = intval($filter['make']);
          $query .= " AND mk.MakeID = {$makeID}";
      }
  
      // Filter theo mẫu xe
      if (!empty($filter['model'])) {
          $modelID = intval($filter['model']);
          $query .= " AND m.ModelID = {$modelID}";
      }
  
      // Filter theo loại xe
      if (!empty($filter['type'])) {
          $type = addslashes($filter['type']);
          $query .= " AND vt.NameType = '{$type}'";
      }
  
      // Sort (đã loại bỏ ActualReturnDate và Year)
      if (!empty($filter['sort']['sort']) && !empty($filter['sort']['sortDirection'])) {
          $validFields = [
              'OrderDetailID' => 'rod.OrderDetailID',
              'ReturnDate'    => 'rod.ReturnDate'
          ];
          $sortKey = $filter['sort']['sort'];
          $sortField = isset($validFields[$sortKey]) ? $validFields[$sortKey] : 'rod.OrderDetailID';
          $sortDirection = strtoupper($filter['sort']['sortDirection']) === 'DESC' ? 'DESC' : 'ASC';
          $query .= " ORDER BY {$sortField} {$sortDirection}";
      } else {
          $query .= " ORDER BY rod.OrderDetailID ASC";
      }
  
      return $query;
    }
  
    public function create($data){

        // Bắt đầu giao dịch để đảm bảo tính toàn vẹn dữ liệu
        mysqli_begin_transaction($this->con);

        // Tạo câu lệnh SQL để chèn dữ liệu vào bảng Inspections
        $sqlInsert = "INSERT INTO Inspections (
                        RentalOrderDetailID, UserID, InspectionDate, InspectionTime, TotalFineAmount
                    ) VALUES (
                        '{$data['RentalOrderDetailID']}', '{$data['UserID']}', '{$data['InspectionDate']}', '{$data['InspectionTime']}', '{$data['TotalFineAmount']}'
                    )";

        // Thực thi câu lệnh SQL để thêm dữ liệu vào bảng Inspections
        $resultInsert = mysqli_query($this->con, $sqlInsert);

        if (!$resultInsert) {
            // Nếu câu lệnh insert không thành công, rollback giao dịch và trả về false
            mysqli_rollback($this->con);
            return false;
        }

        // Tạo câu lệnh SQL để cập nhật status của RentalOrderDetail
        $sqlUpdate = "UPDATE RentalOrderDetails SET status = 2 WHERE OrderDetailID = '{$data['RentalOrderDetailID']}'";

        // Thực thi câu lệnh SQL để cập nhật status
        $resultUpdate = mysqli_query($this->con, $sqlUpdate);

        if (!$resultUpdate) {
            // Nếu câu lệnh update không thành công, rollback giao dịch và trả về false
            mysqli_rollback($this->con);
            return false;
        }

        // Commit giao dịch nếu cả 2 câu lệnh đều thành công
        mysqli_commit($this->con);

        return true;
    }

    public function update($data){
        // Bắt đầu giao dịch để đảm bảo tính toàn vẹn dữ liệu
        mysqli_begin_transaction($this->con);
    
        // Tạo câu lệnh SQL để cập nhật dữ liệu trong bảng Inspections
        $sqlUpdate = "UPDATE Inspections SET
                        UserID = '{$data['UserID']}',
                        InspectionDate = '{$data['InspectionDate']}',
                        InspectionTime = '{$data['InspectionTime']}',
                        TotalFineAmount = '{$data['TotalFineAmount']}'
                      WHERE RentalOrderDetailID = '{$data['RentalOrderDetailID']}'";
    
        // Thực thi câu lệnh SQL để cập nhật dữ liệu trong bảng Inspections
        $resultUpdate = mysqli_query($this->con, $sqlUpdate);
    
        if (!$resultUpdate) {
            // Nếu câu lệnh update không thành công, rollback giao dịch và trả về false
            mysqli_rollback($this->con);
            return false;
        }
    
        // Tạo câu lệnh SQL để cập nhật status của RentalOrderDetail (nếu cần thiết)
        // (Ở đây tôi giả sử việc cập nhật trạng thái là cần thiết, nếu không cần có thể bỏ qua phần này)
        $sqlUpdateStatus = "UPDATE RentalOrderDetails SET status = 2 WHERE OrderDetailID = '{$data['RentalOrderDetailID']}'";
    
        // Thực thi câu lệnh SQL để cập nhật status
        $resultUpdateStatus = mysqli_query($this->con, $sqlUpdateStatus);
    
        if (!$resultUpdateStatus) {
            // Nếu câu lệnh update status không thành công, rollback giao dịch và trả về false
            mysqli_rollback($this->con);
            return false;
        }
        // Commit giao dịch nếu cả 2 câu lệnh đều thành công
        mysqli_commit($this->con);
    
        return true;
    }
    
    public function delete($rentalOrderDetailID){
        // Bắt đầu giao dịch để đảm bảo tính toàn vẹn dữ liệu
        mysqli_begin_transaction($this->con);
    
        // Tạo câu lệnh SQL để xóa dữ liệu trong bảng Inspections
        $sqlDelete = "DELETE FROM Inspections WHERE RentalOrderDetailID = '{$rentalOrderDetailID}'";
    
        // Thực thi câu lệnh SQL để xóa dữ liệu trong bảng Inspections
        $resultDelete = mysqli_query($this->con, $sqlDelete);
    
        if (!$resultDelete) {
            // Nếu câu lệnh delete không thành công, rollback giao dịch và trả về false
            mysqli_rollback($this->con);
            return false;
        }
    
        // Tạo câu lệnh SQL để cập nhật lại trạng thái của RentalOrderDetail nếu cần
        // Ví dụ: có thể cần cập nhật trạng thái hoặc xóa bản ghi nào đó liên quan
        $sqlUpdateStatus = "UPDATE RentalOrderDetails SET status = 1 WHERE OrderDetailID = '{$rentalOrderDetailID}'";
    
        // Thực thi câu lệnh SQL để cập nhật lại trạng thái (nếu cần)
        $resultUpdateStatus = mysqli_query($this->con, $sqlUpdateStatus);
    
        if (!$resultUpdateStatus) {
            // Nếu câu lệnh update status không thành công, rollback giao dịch và trả về false
            mysqli_rollback($this->con);
            return false;
        }
    
        // Commit giao dịch nếu tất cả các câu lệnh đều thành công
        mysqli_commit($this->con);
    
        return true;
    }
    


    public function getByOrderDetailID($orderDetailID) {
        // Chuẩn bị câu lệnh SQL
        $sql = "SELECT * FROM Inspections WHERE RentalOrderDetailID = ?";
    
        // Chuẩn bị statement
        $stmt = mysqli_prepare($this->con, $sql);
        if (!$stmt) {
            error_log("MySQLi Prepare failed: " . mysqli_error($this->con));
            return null;
        }
    
        // Gắn tham số
        mysqli_stmt_bind_param($stmt, "i", $orderDetailID); // "i" nghĩa là số nguyên
    
        // Thực thi
        if (!mysqli_stmt_execute($stmt)) {
            error_log("MySQLi Execute failed: " . mysqli_stmt_error($stmt));
            return null;
        }
    
        // Lấy kết quả
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            error_log("MySQLi Get result failed: " . mysqli_stmt_error($stmt));
            return null;
        }
    
        // Lấy bản ghi
        $inspection = mysqli_fetch_assoc($result);
    
        return $inspection ?: null;
    }
    


    // public function getByOrderDetailID($orderDetailID) {
    //    return "DCMMMMMMMMMMMMMMMMMMMMMM";
    
    // }
  
}
?>