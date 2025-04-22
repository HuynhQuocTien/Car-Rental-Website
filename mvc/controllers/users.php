<?php

class Users extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Users",
            "Page"=>"pages/users",
            "Script"=>"users",
        ],
        "admin");
    }
}
?>
