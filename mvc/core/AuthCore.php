<?php
class AuthCore{
    public static function onLogin(){
        if(isset($_COOKIE['token'])){
            $nguoidung = new AccountModel();
            $token = $_COOKIE['token'];
            if($nguoidung->validateToken($token) == true){
                header("Location: ../Home");
            }
        }
    }
    public static function checkAuthentication(){
        $token = $_COOKIE['token'];
        $account = new AccountModel();
        if(!isset($_COOKIE['token']) || $account->validateToken($token) == false){
            setcookie("token", "", time() - 3600);
            $path = BASE_URL;
            header("Location: $path");
            exit;
        }
    }
}
?>