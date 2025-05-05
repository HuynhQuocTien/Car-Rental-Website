<?php
class Permissions extends Controller {
    public $roleModel;
    public function __construct() {
        parent::__construct();
        $this->roleModel = $this->model("RoleModel");
        require_once "./mvc/core/Pagination.php";
    }
    public function default() {
        if(AuthCore::checkRole(18,4)) {
        $this->view("main_layout", [
            "Title"=>"Permissions",
            "Page"=>"pages/permissions",
            "Script"=> "permissions",
            "roles"=>$_SESSION['Roles'],
        ],
        "admin");
        } else {
            $this->view("single_layout", [
                "Title"=>"403",
                "Page"=>"pages/403",
            ],
            "admin");
            exit;
        }
    }

    public function renderData(){
        $data = $this->roleModel->renderData();
        echo json_encode($data);
    }

    public function create(){
        if($_SERVER["REQUEST_METHOD"] == "POST" && AuthCore::checkRole(18,1) ) { 
            $name = $_POST['name'];
            $roles = $_POST['roles'];
            $result = $this->roleModel->create($name,$roles);
            echo $result;
        }
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && AuthCore::checkRole(18,2)) {
            $roleID = $_POST['roleID'];
            $name = $_POST['name'];
            $roles = $_POST['roles'];
            $result = $this->roleModel->update($roleID,$name,$roles);
            echo $result;
        }
    }
    public function delete(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && AuthCore::checkRole(18,3)) {
            $roleID = $_POST['roleID'];
            $result = $this->roleModel->delete($roleID);
            echo $result;
        }
    }
    public function get(){
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
    public function getRole()
    {
        AuthCore::checkAuthentication();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            echo json_encode($_SESSION['Roles']);
        }
    }
    public function getQuery($filter, $input, $args, $lastURL){
        $sql = $this->roleModel->getQuery($filter, $input, $args, $lastURL);
        return $sql;
    }
}

?>
