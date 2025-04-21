<?php

class Reviews extends Controller {
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Reviews",
            "Page"=>"pages/reviews",
        ],
        "admin");
    }
}
?>
