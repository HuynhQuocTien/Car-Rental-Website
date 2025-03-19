<?php

class Dashboard extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Admin - Dashboard",
            "Page"=>"dashboard"
        ],
        "admin");
    }
}
?>
