<?php
class App{
    protected $controller="Home";
    protected $action="default";
    protected $params=[];

    function __construct(){

        $arr = $this->UrlProcess();
        
        // // Kiểm tra role hợp lệ
        // if ($arr[0] == NULL || !in_array($arr[0], ['admin', 'user'])) {
        //     $this->controller = 'myerror';
        //     require_once "./mvc/controllers/myerror.php";
        //     $this->controller = new $this->controller;
        //     $this->action = 'default';
        //     call_user_func_array([$this->controller, $this->action], []);
        //     return;
        // }


        // Controller
        // print_r($arr[1]);
        if($arr != NULL) {
            if( isset($arr[1]) && file_exists("./mvc/controllers/".$arr[1].".php") ){
                $this->controller = $arr[1];
                unset($arr[1]);
            } else {
                $this->controller = 'myerror';
            }
        }
        require_once "./mvc/controllers/". $this->controller .".php";
        $this->controller = new $this->controller;

        // Action
        if(isset($arr[2])){
            if(method_exists( $this->controller , $arr[2]) ){
                $this->action = $arr[2];
            } else {
                // Hien thi trang loi
                $this->controller = 'myerror';
                require_once "./mvc/controllers/". $this->controller .".php";
                $this->controller = new $this->controller;
            }
            unset($arr[2]);
        }
        // Params
        $this->params = $arr?array_values($arr):[];
        // print_r($this->params);
        // print_r($this->controller);
        // print_r($this->action);
        try {
            call_user_func_array([$this->controller, $this->action], $this->params );
        } catch (ArgumentCountError $e) {
            $this->controller = 'myerror';
            require_once "./mvc/controllers/". $this->controller .".php";
            $this->controller = new $this->controller;
            $this->action = 'default';
            call_user_func_array([$this->controller, $this->action], []);
        }

    }

    function UrlProcess(){
        if(isset($_GET["url"]) ){
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}
?>