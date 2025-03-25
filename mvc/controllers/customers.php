<?php

class Customers extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Customers",
            "Page"=>"pages/customers",
        ],
        "admin");
    }
}
?>
