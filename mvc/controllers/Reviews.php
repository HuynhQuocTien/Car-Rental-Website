<?php

class Reviews extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Reviews",
            "Page"=>"reviews",
        ],
        "admin");
    }
}
?>
