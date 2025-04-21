<?php

class Approval extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"About - Car Rental",
            "Page"=>"pages/approval"
        ],
        "admin");
    }
}
?>