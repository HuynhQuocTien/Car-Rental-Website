<?php

class Dashboard extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Dashboard",
            "Page"=>"pages/dashboard"
        ],
        "admin");
    }
}
?>
