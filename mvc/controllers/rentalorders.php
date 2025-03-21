<?php

class RentalOrders extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Rental Orders",
            "Page"=>"rentalorders",
        ],
        "admin");
    }
}
?>
