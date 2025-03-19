<?php

class Home extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>" Home -  Car Rental",
            "Page"=>"home"
        ],
        "user");
    }
}
?>
