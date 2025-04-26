<?php

class About extends Controller {
    public function default() {
        if(isset($_COOKIE['token'])){
            AuthCore::checkAuthentication();
        }
        $this->view("main_layout", [
            "Title"=>"About - Car Rental",
            "Page"=>"about"
        ],
        "user");
    }
}
?>