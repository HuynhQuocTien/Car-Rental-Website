<?php

class Home extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Hệ thống thuê xe",
            "Page"=>"home"
        ],
        "user");
    }
}
?>
