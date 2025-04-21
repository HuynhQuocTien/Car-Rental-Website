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
                    header("Location: ../auth/signin");
                }else if($web[0] == "user"){
                    header("Location: ../home");
                }
            }
        }
    }
    public static function checkAuthentication(){
        $web = isset($_GET["url"]) ? explode("/", filter_var(trim($_GET["url"], "/"))) : null;
        $token = $_COOKIE['token'] ?? null;
        $accountModel = new AccountModel();
        if(!isset($_COOKIE['token']) || $accountModel->validateToken($token) == false){
            setcookie("token", "", time() - 3600);
            if($web[0] == "admin"){
                header("Location: ./auth/signin");
            }
        }
    }
}
?>