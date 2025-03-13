<?php

class ReviewModel extends Database {

    public function createReview($customerId, $vehicleId, $rating, $comment, $reviewDate) {
        $sql = "INSERT INTO Reviews (CustomerID, VehiclesID, Rating, Comment, ReviewDate) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$customerId, $vehicleId, $rating, $comment, $reviewDate]);
    }

    public function getReviewById($reviewId) {
        $sql = "SELECT * FROM Reviews WHERE ReviewID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$reviewId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getReviewsByVehicle($vehicleId) {
        $sql = "SELECT * FROM Reviews WHERE VehiclesID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateReview($reviewId, $rating, $comment, $reviewDate) {
        $sql = "UPDATE Reviews SET Rating = ?, Comment = ?, ReviewDate = ? 
                WHERE ReviewID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$rating, $comment, $reviewDate, $reviewId]);
    }

    public function deleteReview($reviewId) {
        $sql = "DELETE FROM Reviews WHERE ReviewID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$reviewId]);
    }
}

?>