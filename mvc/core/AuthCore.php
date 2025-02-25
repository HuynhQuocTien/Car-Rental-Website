<?php
class AuthCore{
    public static function onLogin(){
        if(isset($_COOKIE['token'])){
            $nguoidung = new NguoiDungModel();
            $token = $_COOKIE['token'];
            if($nguoidung->validateToken($token) == true){
                header("Location: ../Home");
            }
        }
    }
    public static function checkAuthentication(){
        $token = $_COOKIE['token'];
        $nguoidung = new NguoiDungModel();
        if(!isset($_COOKIE['token']) || $nguoidung->validateToken($token) == false){
            setcookie("token", "", time() - 3600);
            $path = login_path;
            header("Location: $path");
            exit;
        }
    }
}
?>