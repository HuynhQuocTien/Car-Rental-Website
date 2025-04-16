<?php
require_once "./mvc/models/AccountModel.php";
class AuthCore{
    public static function onLogin(){
        $web = isset($_GET["url"]) ? explode("/", filter_var(trim($_GET["url"], "/"))) : null;
        if(isset($_COOKIE['token'])){
            $accountModel = new AccountModel();
            $token = $_COOKIE['token'];
            if($accountModel->validateToken($token) == true){
                if($web[0] == "admin"){
                    header("Location: ../Welcome");
                }else if($web[0] == "user"){
                    header("Location: ../home");
                }
            }
        }
    }
    public static function checkAuthentication(){
        $token = $_COOKIE['token'];
        $accountModel = new AccountModel();
        if(!isset($_COOKIE['token']) || $accountModel->validateToken($token) == false){
            setcookie("token", "", time() - 3600);
            $path = BASE_URL;
            header("Location: $path");
            exit;
        }
    }
}
?>