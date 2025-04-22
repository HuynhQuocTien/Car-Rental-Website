<?php

class Promotions extends Controller {
    public $promotionModel;
    public function __construct() {
        parent::__construct();
        $this->promotionModel =$this->model("PromotionModel");

        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Promotions",
            "Page"=>"pages/promotions",
            "Script" =>"promotions",
        ],
        "admin");
    }

    public function getQuery($filter, $input, $args, $lastURL){

        $sql = $this->promotionModel->getQuery($filter, $input, $args, $lastURL);
        return $sql;
    }
}
?>