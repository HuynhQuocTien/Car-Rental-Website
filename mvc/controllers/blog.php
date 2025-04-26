<?php

class Blog extends Controller {
    public function default() {
        if(isset($_COOKIE['token'])){
            AuthCore::checkAuthentication();
        }
        $this->view("main_layout", [
            "Title"=>"Blog",
            "Page"=>"blog"
        ],
        "user");
    }
}
?>