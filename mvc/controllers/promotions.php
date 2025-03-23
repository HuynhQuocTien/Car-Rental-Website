<?php

class Promotions extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Promotions",
            "Page"=>"pages/promotions"
        ],
        "admin");
    }
}
?>