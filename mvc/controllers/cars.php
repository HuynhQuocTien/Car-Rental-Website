<?php

class Cars extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Cars",
            "Page"=>"cars"
        ],
        "user");
    }
}
?>