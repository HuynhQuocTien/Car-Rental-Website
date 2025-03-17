<?php
class Detailcar extends Controller {
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Chi tiết xe",
            "Page"=>"detail-car",
        ],
        "user");
    }
}
?>