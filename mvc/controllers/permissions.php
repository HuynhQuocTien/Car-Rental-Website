<?php

class Permissions extends Controller {
    public $roleModel;
    public function __construct() {
        parent::__construct();
        $this->roleModel = $this->model("RoleModel");

        require_once "./mvc/core/Pagination.php";

    }
    public function default() {
        $this->view("main_layout", [
            "Title"=>"Permissions",
            "Page"=>"pages/permissions",
            "Script"=> "permissions",
        ],
        "admin");
    }

    public function renderData(){
        $data = $this->roleModel->renderData();
        echo json_encode($data);
    }

    public function create(){
    // {&& AuthCore::checkPermission("nhomquyen","create")
        if($_SERVER["REQUEST_METHOD"] == "POST" ) { 
            $name = $_POST['name'];
            $roles = $_POST['roles'];
            $result = $this->roleModel->create($name,$roles);
            echo $result;
        }
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roleID = $_POST['roleID'];
            $name = $_POST['name'];
            $roles = $_POST['roles'];
            $result = $this->roleModel->update($roleID,$name,$roles);
            echo $result;
        }
    }
    public function delete(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roleID = $_POST['roleID'];
            $result = $this->roleModel->delete($roleID);
            echo $result;
        }
    }
    public function get(){
        // && AuthCore::checkPermission("nhomquyen","view")
        if($_SERVER["REQUEST_METHOD"] == "POST" ) {
            $result = $this->roleModel->get($_POST['roleID']);
            if($result){
                $permissions = $this->roleModel->getPermissions($result['RoleID']);
                $result['permissions'] = $permissions;
            } else {
                $result = false;
            }
            echo json_encode($result);
        }
    }
    public function getQuery($filter, $input, $args, $lastURL){
        $sql = $this->roleModel->getQuery($filter, $input, $args, $lastURL);
        return $sql;
    }


}
?>
