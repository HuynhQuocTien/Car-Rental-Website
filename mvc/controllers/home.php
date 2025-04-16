<?php

class Home extends Controller {
    public function default() {
        if(isset($_COOKIE['token'])){
            AuthCore::checkAuthentication();
        }
        $this->view("main_layout", [
            "Title"=>" Home -  Car Rental",
            "Page"=>"home"
        ],
        "user"); //User hay admin
    }
}
?>