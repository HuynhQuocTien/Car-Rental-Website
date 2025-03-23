<?php

class Users extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Users",
            "Page"=>"pages/users",
        ],
        "admin");
    }
    public function customers() {
        $this->view("main_layout", [
            "Title"=>"Customers",
            "Page"=>"pages/users/customers",
        ],
        "admin");
    }
    public function staffs() {
        $this->view("main_layout", [
            "Title"=>"Staffs",
            "Page"=>"pages/users/staffs",
        ],
        "admin");
    }
}
?>
