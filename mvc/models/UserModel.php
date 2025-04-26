<?php

class UserModel extends Database {


    public function __construct() {
        parent::__construct();
    }

    public function getQuery($filter, $input, $args, $lastURL)
    {
        $query = "SELECT * FROM Accounts a
                    LEFT JOIN Roles r ON a.RoleID = r.RoleID
                    LEFT JOIN Users u ON a.AccountID = u.AccountID
                    WHERE a.Is_Delete = 0 AND u.Is_Delete = 0";
        if ($input) {
            $query = $query . " AND (u.FullName LIKE '%{$input}%' OR u.IdentityCard LIKE '%{$input}%')";
        }
        $query = $query . " ORDER BY u.UserID ASC";
        return $query;
    }   
    public function getByAccountID($accountID){
        $sql = "SELECT * FROM `Users` WHERE `AccountID` = '$accountID'";
        $result = mysqli_query($this->con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row;  // Trả về một dòng duy nhất
        }
        return null; 
    }

    public function updateByAccountID($accountID, $name, $phone, $birth, $idCard, $sex){
         // Kiểm tra dữ liệu đầu vào
        if (empty($accountID)) {
            return [
                "success" => false,
                "message" => "AccountID không hợp lệ"
            ];
        }

        // Chuẩn hóa định dạng ngày sinh về YYYY-MM-DD
        $birthDate = date_create($birth); // dùng date_create cho linh hoạt
            if (!$birthDate) {
                return [
                    "success" => false,
                    "message" => "Ngày sinh không hợp lệ. Định dạng phải là YYYY-MM-DD hoặc dạng tương tự."
                ];
            }
            $birthFormatted = $birthDate->format('Y-m-d');

            // Làm sạch dữ liệu đầu vào
            $name = mysqli_real_escape_string($this->con, $name);
            $phone = mysqli_real_escape_string($this->con, $phone);
            $birthFormatted = mysqli_real_escape_string($this->con, $birthFormatted);
            $idCard = mysqli_real_escape_string($this->con, $idCard);
            $sex = mysqli_real_escape_string($this->con, $sex);
            $accountID = mysqli_real_escape_string($this->con, $accountID);

            // Truy vấn SQL để cập nhật thông tin trong bảng Customers
            $sql = "UPDATE `Users` SET `FullName` = ?, `PhoneNumber` = ?, `DateOfBirth` = ?, `IdentityCard` = ?, `Sex` = ? WHERE `AccountID` = ?";

            // Log câu lệnh SQL để kiểm tra
            error_log("SQL Query: " . $sql);

            // Chuẩn bị câu lệnh SQL
            $stmt = mysqli_prepare($this->con, $sql);

            if ($stmt) {
                // Gắn các tham số vào câu lệnh SQL
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $phone, $birthFormatted, $idCard, $sex, $accountID);

                // Log giá trị các tham số để kiểm tra
                error_log("Binding parameters: name = $name, phone = $phone, birth = $birthFormatted, idCard = $idCard, sex = $sex, accountID = $accountID");

                // Thực thi câu lệnh SQL
                if (mysqli_stmt_execute($stmt)) {
                    return [
                        "success" => true,
                        "message" => "Cập nhật thông profile admin thành công"
                    ];
                } else {
                    // Log lỗi khi thực thi câu lệnh
                    error_log("SQL Error: " . mysqli_error($this->con));
                    return [
                        "success" => false,
                        "message" => "Lỗi khi cập nhật: " . mysqli_error($this->con)
                    ];
                }
            } else {
                // Log lỗi khi không thể chuẩn bị câu lệnh
                error_log("SQL Prepare Error: " . mysqli_error($this->con));
                return [
                    "success" => false,
                    "message" => "Không thể chuẩn bị truy vấn: " . mysqli_error($this->con)
                ];
            }
    }

}

?>