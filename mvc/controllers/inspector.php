<?php

class Inspector extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Inspector",
            "Page"=>"pages/inspector"
        ],
        "admin");
    }
}
?>