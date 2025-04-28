<?php

class ImagesInspectModel extends Database {

    public function addInspectionImage($inspectionId, $imageUrl) {
        $sql = "INSERT INTO ImagesInspect (InspectionID, ImageURL) VALUES (?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$inspectionId, $imageUrl]);
    }

    public function getImagesByInspectionId($inspectionId) {
        $sql = "SELECT * FROM ImagesInspect WHERE InspectionID = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$inspectionId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteInspectionImage($id) {
        $sql = "DELETE FROM ImagesInspect WHERE Id = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>
