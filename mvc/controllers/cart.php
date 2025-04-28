<?php

    class Cart extends Controller {
        public function default() {
            // $this->view("main_layout", [
            //     "Title"=>"Giỏ hàng",
            //     "Page"=>"pages/cart",
            //     "Script" => "cart",
            // ],"user");
            $this->view("single_layout", [
                "Page" => "error/404",
                "Title" => "Lỗi !"
            ]);
        }

        public function test() {
            echo "test cart";
        }
    }
?>