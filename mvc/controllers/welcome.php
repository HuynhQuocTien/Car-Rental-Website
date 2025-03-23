<?php

class Welcome extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Welcome",
            "Page"=>"pages/welcome",
        ],
        "admin");
        
    }
}
?>
