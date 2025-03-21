<?php

class VehicleCatalog extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Vehicle Catalog",
            "Page"=>"vehiclecatalog"
        ],
        "admin");
    }
}
?>
