<?php
class Myerror extends Controller{

    public function default()
    {
        $this->view("single_layout", [
            "Page" => "error/404",
            "Title" => "Lỗi !"
        ]);
    }

    public function noRole(){
        $this->view("single_layout", [
            "Page" => "error/403",
            "Title" => "Lỗi !"
        ]);
    }
}
?>