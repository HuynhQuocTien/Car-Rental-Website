<?php

class Users extends Controller {
    public $accountModel;
    public $userModel;
    public function __construct() {
        parent::__construct();
        $this->accountModel = $this->model("AccountModel");
        $this->userModel = $this->model("UserModel");
        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        AuthCore::checkAuthentication();
        $this->view("main_layout", [
            "Title"=>"Users",
            "Page"=>"pages/users",
            "Script"=>"users",
        ],
        "admin");
    }

    public function getQuery($filter, $input, $args, $lastURL){

        $sql = $this->userModel->getQuery($filter, $input, $args, $lastURL);
        return $sql;
    }
}
?>
