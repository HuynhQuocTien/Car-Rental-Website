<?php

class DamageTypes extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Damage Types",
            "Page"=>"damagetypes",
        ],
        "admin");
    }
}
?>
