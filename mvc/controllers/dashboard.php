<?php

class Dashboard extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Dashboard",
            "Page"=>"dashboard"
        ],
        "admin");
    }
}
?>
