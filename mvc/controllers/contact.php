<?php

class Contact extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Contact",
            "Page"=>"contact"
        ],
        "user");
    }
}
?>