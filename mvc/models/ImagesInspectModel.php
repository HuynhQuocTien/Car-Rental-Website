<?php

require_once 'Database.php';

class ImagesInspectModel extends Database {

    // Add a new inspection image
    public function addInspectionImage($inspectionId, $imageUrl) {
        $sql = "INSERT INTO ImagesInspect (InspectionID, ImageURL) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$inspectionId, $imageUrl]);
    }

    // Get all images for a specific inspection
    public function getImagesByInspectionId($inspectionId) {
        $sql = "SELECT * FROM ImagesInspect WHERE InspectionID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$inspectionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete an inspection image
    public function deleteInspectionImage($id) {
        $sql = "DELETE FROM ImagesInspect WHERE Id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>
