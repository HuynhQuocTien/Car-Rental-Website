<?php


class PaymentModel extends Database {
  public function getDataByDateRange($startDate, $endDate){
      $query = "SELECT * FROM `Payments` 
                WHERE `PaymentDate` BETWEEN '$startDate' AND '$endDate';";
  
      $stmt = mysqli_query($this->con, $query);
  
      if ($stmt) {
          $results = [];
          while ($row = $stmt->fetch_assoc()) {
              $results[] = $row;
          }
          return $results;
      } else {
          return false;
      }
    }
}

?>