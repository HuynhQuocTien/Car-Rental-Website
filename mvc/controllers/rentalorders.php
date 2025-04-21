<?php

class RentalOrders extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Rental Orders",
            "Page"=>"pages/rentalorders",
        ],
        "admin");
    }
}
?>
