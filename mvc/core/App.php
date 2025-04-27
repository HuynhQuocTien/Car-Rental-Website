<?php
class App{
    protected $controller = "Home";
    protected $action = "default"; //Lấy hàm trong controller
    protected $params = [];

    function __construct(){
        $arr = $this->UrlProcess(); //Localhost/user/home => ['user', 'home'] localhost/admin hoặc localhost/user
        if (!$arr || empty($arr[0])) {
            header("Location: /user/home");
            exit;
        }

        // Kiểm tra role hợp lệ ('admin' hoặc 'user')
        if (in_array($arr[0], ['admin', 'user'])) {
            // Nếu chỉ có 'user/' hoặc 'admin/', tự động chuyển đến 'home'
            if (count($arr) == 1) {
                header("Location: /" . $arr[0]  .($arr[0] == "user" ? "/home" : "/auth/signin"));
                exit;
            }
        } else {
            // Nếu không phải user/admin, đưa về lỗi
            $this->controller = 'myerror';
            require_once "./mvc/controllers/myerror.php";
            $this->controller = new $this->controller;
            $this->action = 'default';
            call_user_func_array([$this->controller, $this->action], []);
            return;
        }

        // Controller
        if (isset($arr[1]) && file_exists("./mvc/controllers/" . $arr[1] . ".php")) {
            $this->controller = $arr[1];
            unset($arr[1]);
        } else {
            $this->controller = 'myerror';
        }

        require_once "./mvc/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Action
        if (isset($arr[2])) {
            if (method_exists($this->controller, $arr[2])) {
                $this->action = $arr[2];
            } else {
                $this->controller = 'myerror';
                require_once "./mvc/controllers/" . $this->controller . ".php";
                $this->controller = new $this->controller;
            }
            unset($arr[2]);
        }

        // Params
        $this->params = $arr ? array_values($arr) : [];
        // $this->params = array_slice($arr, 1) ? array_values(array_slice($arr, 1)) : [];
        // Gọi Controller + Action
        try {
            call_user_func_array([$this->controller, $this->action], $this->params);
        } catch (ArgumentCountError $e) {
            $this->controller = 'myerror';
            require_once "./mvc/controllers/" . $this->controller . ".php";
            $this->controller = new $this->controller;
            $this->action = 'default';
            call_user_func_array([$this->controller, $this->action], []);
        }
    }

    function UrlProcess(){
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return null;
    }
}
