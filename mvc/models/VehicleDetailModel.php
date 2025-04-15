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
                    Year, Transmission, FuelType, FuelConsumption,
                    Status, Is_Delete
                ) VALUES (
                    '{$data['vehicleID']}', '{$data['colorID']}', '{$data['licensePlateNumber']}', '{$data['mileage']}',
                    '{$data['year']}', '{$data['transmission']}', '{$data['fuelType']}', '{$data['fuelConsumption']}',
                    '{$data['status']}', 0
                )";
        $result = mysqli_query($this->con, $sql);
        if (!$result) $valid = false;
        return $valid;
    }

    public function update($vehicleDetailID, $data)
    {
        $valid = true;
        $sql = "UPDATE VehicleDetails SET 
                    VehicleID = '{$data['vehicleID']}',
                    ColorID = '{$data['colorID']}',
                    LicensePlateNumber = '{$data['licensePlateNumber']}',
                    Mileage = '{$data['mileage']}',
                    Year = '{$data['year']}',
                    Transmission = '{$data['transmission']}',
                    FuelType = '{$data['fuelType']}',
                    FuelConsumption = '{$data['fuelConsumption']}',
                    Status = '{$data['status']}'
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

    public function getQuery($input = null, $filter = [], $lastURL = 'VehicleDetails')
    {
        $query = "SELECT vd.*, c.ColorName, vi.ImageID, vi.ImageID,  vi.ImageURL, vi.IsPrimary 
                    FROM VehicleDetails vd
                    LEFT JOIN Colors c ON vd.ColorID = c.ColorID
                    LEFT JOIN VehicleImages vi ON vd.VehicleDetailID = vi.VehicleDetailID
                  WHERE vd.Is_Delete = 0";

        $query .= " ORDER BY vd.VehicleDetailID ASC";
        return $query;
    }
}
?>
