<?php

class Inpector extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Inpector",
            "Page"=>"pages/Inpector"
        ],
        "admin");
    }
}
?>