<?php

class Vehicles extends Controller {
    public function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }
    public function default() {
        $arrrs = $this->UrlProcess();
        if($arrrs[0] == "admin"){
            $this->view("main_layout", [
                "Title"=>"Vehicles",
                "Page"=>"vehicles",
            ],
            "admin");
        } else {
            $this->view("main_layout", [
                "Title"=>"Vehicles",
                "Page"=>"vehicles",
            ],
            "user");
        }
    }
}
?>