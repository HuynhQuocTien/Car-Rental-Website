<?php

class Payments extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Payments",
            "Page"=>"payments",
        ],
        "admin");
    }
}
?>
