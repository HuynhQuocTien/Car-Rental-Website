<?php
class VehicleModel extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0";
        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getById($id)
    {
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0 AND VehicleID = '$id'";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function update($vehicleID, $data)
    {
        $valid = true;
        $sql = "UPDATE Vehicles SET 
                MakeID = '{$data['makeID']}',
                ModelID = '{$data['modelID']}',
                VehicleTypesID = '{$data['vehicleTypeID']}',
                Seats = '{$data['seats']}',
                HourlyPrice = '{$data['hourlyPrice']}',
                DailyPrice = '{$data['dailyPrice']}',
                WeeklyPrice = '{$data['weeklyPrice']}',
                MonthlyPrice = '{$data['monthlyPrice']}',
                PromotionID = '{$data['promotionID']}',
                Active = '{$data['active']}',
                WHERE VehicleID = '$vehicleID'";

        $result = mysqli_query($this->con, $sql);
        if (!$result)
            $valid = false;
        return $valid;
    }


    public function create($data)
    {
        $valid = true;
        $sql = "INSERT INTO `Vehicles` (
                `MakeID`, `ModelID`, `VehicleTypesID`, `Seats`,
                `HourlyPrice`, `DailyPrice`, `WeeklyPrice`, `MonthlyPrice`, `Quantity`,
                 `PromotionID`, `Active`
                ) VALUES (
                '{$data['makeID']}', '{$data['modelID']}', '{$data['vehicleTypeID']}', '{$data['seats']}',
                '{$data['hourlyPrice']}', '{$data['dailyPrice']}', '{$data['weeklyPrice']}', '{$data['monthlyPrice']}','0',
                 '{$data['promotionID']}', '{$data['active']}'
                )";
        $result = mysqli_query($this->con, $sql);
        if (!$result)
            $valid = false;
        return $valid;
    }

    public function delete($id)
    {
        $valid = true;
        $sql = "UPDATE Vehicles SET Is_Delete = 1 WHERE VehicleID = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result)
            $valid = false;
        return $valid;
    }

    public function getQuery($filter, $input, $args, $lastURL)
    {
        if ($lastURL === "vehicles") {
            $lastURL = "Vehicles";
        }

        $query = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                  FROM $lastURL v
                  JOIN Makes mk ON v.MakeID = mk.MakeID
                  JOIN Models md ON v.ModelID = md.ModelID
                  JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                  WHERE v.Is_Delete = 0";

        if ($input) {
            $query = $query . " AND (mk.MakeName LIKE '%{$input}%' OR 
                            md.ModelName LIKE '%{$input}%' OR 
                            vt.NameType LIKE '%{$input}%') ";
        }
        if (isset($filter) && !empty($filter)) {
            if (isset($filter['makeID']) && !empty($filter['makeID'])) {
                // Xử lý mảng giá trị MakeID
                $makeIDs = implode(",", array_map('intval', $filter['makeID']));
                $query .= " AND v.MakeID IN ({$makeIDs})";
            }
            if (isset($filter['modelID']) && !empty($filter['modelID'])) {
                // Xử lý mảng giá trị ModelID
                $modelIDs = implode(",", array_map('intval', $filter['modelID']));
                $query .= " AND v.ModelID IN ({$modelIDs})";
            }
            if (isset($filter['vehicleTypeID']) && !empty($filter['vehicleTypeID'])) {
                // Xử lý mảng giá trị VehicleTypesID
                $vehicleTypeIDs = implode(",", array_map('intval', $filter['vehicleTypeID']));
                $query .= " AND v.VehicleTypesID IN ({$vehicleTypeIDs})";
            }
            if (isset($filter['seats']) && !empty($filter['seats'])) {
                // Xử lý mảng giá trị Seats
                $seats = implode(",", array_map('intval', $filter['seats']));
                $query .= " AND v.seats IN ({$seats})";
            }
        }
        

        $query .= " ORDER BY v.VehicleID ASC";
        return $query;
    }

    // Additional methods if needed
    public function getFeaturedVehicles($limit = 5)
    {
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0 AND v.Is_Feature = 1 AND v.Active = 1
                LIMIT $limit";

        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAvailableVehicles()
    {
        $sql = "SELECT v.*, mk.MakeName, md.ModelName, vt.NameType
                FROM Vehicles v
                JOIN Makes mk ON v.MakeID = mk.MakeID
                JOIN Models md ON v.ModelID = md.ModelID
                JOIN VehicleTypes vt ON v.VehicleTypesID = vt.VehicleTypesID
                WHERE v.Is_Delete = 0 AND v.Active = 1";

        $result = mysqli_query($this->con, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getImage($id)
    {
        $defaultImage = "https://res.cloudinary.com/dapudsvwl/image/upload/v1745000059/dvgjjnwwutuqdrqnpatz.jpg";
        $sql = "SELECT ImageURL
                    FROM VehicleImages
                    WHERE VehicleID = $id
                      AND ImageURL IS NOT NULL
                      AND ImageURL != '';";
        $result = mysqli_query($this->con, $sql);
        if(!(mysqli_num_rows($result) > 0)) {
            $row['ImageURL'] = $defaultImage;
        }
        return $row['ImageURL'];

    }
}
?>