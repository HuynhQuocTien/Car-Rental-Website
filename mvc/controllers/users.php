<?php

class Users extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Users",
            "Page"=>"pages/users",
        ],
        "admin");
    }
}
?>
