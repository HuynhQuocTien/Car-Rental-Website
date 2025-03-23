<?php

class Permissions extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Permissions",
            "Page"=>"pages/permissions",
        ],
        "admin");
    }
}
?>
