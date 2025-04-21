<?php

class Promotions extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Promotions",
            "Page"=>"pages/promotions"
        ],
        "admin");
    }
}
?>