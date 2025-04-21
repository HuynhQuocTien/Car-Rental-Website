<?php

class Welcome extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Welcome",
            "Page"=>"pages/welcome",
        ],
        "admin");
        
    }
}
?>
