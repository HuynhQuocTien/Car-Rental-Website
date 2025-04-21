<?php

class Inspector extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Inspector",
            "Page"=>"pages/inspector"
        ],
        "admin");
    }
}
?>