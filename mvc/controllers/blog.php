<?php

class Blog extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Blog",
            "Page"=>"blog"
        ],
        "user");
    }
}
?>