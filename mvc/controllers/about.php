<?php

class About extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"About - Car Rental",
            "Page"=>"about"
        ],
        "user");
    }
}
?>