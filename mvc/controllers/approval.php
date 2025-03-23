<?php

class Approval extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"About - Car Rental",
            "Page"=>"pages/approval"
        ],
        "admin");
    }
}
?>