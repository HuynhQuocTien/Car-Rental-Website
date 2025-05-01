<?php

class Inspections extends Controller {
    public $InspectionModel;

    function __construct()
    {
        $this->InspectionModel = $this->model("InspectionModel");
        parent::__construct();
    }

    public function default() {
        AuthCore::checkAuthentication();

        $this->view("main_layout", [
            "Title"=>"Inspections",
            "Page"=>"pages/inspections/inspections",
            "Inspection" => $this->InspectionModel->getAllInspections(),
            "Categories" => $this->InspectionModel->getAllCategories(),
            "Colors" => $this->InspectionModel->getAllColors(),
            "Script" => "Inspection"
        ],
        "admin");
    }

    public function damagetypes() {
        $this->view("main_layout", [
            "Title"=>"Damage Types",
            "Page"=>"pages/inspections/damagetypes",
        ],
        "admin");
    }
    public function deposits() {
        $this->view("main_layout", [
            "Title"=>"Deposits",
            "Page"=>"pages/inspections/deposits",
        ],
        "admin");
    }
}
?>
