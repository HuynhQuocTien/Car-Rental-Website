<?php

require_once 'Database.php';

class ReviewModel extends Database {

    // Create a new review
    public function createReview($customerId, $vehicleId, $rating, $comment, $reviewDate) {
        $sql = "INSERT INTO Reviews (CustomerID, VehiclesID, Rating, Comment, ReviewDate) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$customerId, $vehicleId, $rating, $comment, $reviewDate]);
    }

    // Get a review by ID
    public function getReviewById($reviewId) {
        $sql = "SELECT * FROM Reviews WHERE ReviewID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$reviewId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all reviews for a specific vehicle
    public function getReviewsByVehicle($vehicleId) {
        $sql = "SELECT * FROM Reviews WHERE VehiclesID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a review
    public function updateReview($reviewId, $rating, $comment, $reviewDate) {
        $sql = "UPDATE Reviews SET Rating = ?, Comment = ?, ReviewDate = ? 
                WHERE ReviewID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$rating, $comment, $reviewDate, $reviewId]);
    }

    // Delete a review
    public function deleteReview($reviewId) {
        $sql = "DELETE FROM Reviews WHERE ReviewID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$reviewId]);
    }
}

?>