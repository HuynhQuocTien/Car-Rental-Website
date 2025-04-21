<?php

class Payments extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Payments",
            "Page"=>"payments",
        ],
        "admin");
    }
}
?>
