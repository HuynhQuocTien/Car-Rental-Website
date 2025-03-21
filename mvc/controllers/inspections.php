<?php

class Inspections extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Inspections",
            "Page"=>"inspections",
        ],
        "admin");
    }
}
?>
