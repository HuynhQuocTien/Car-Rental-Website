<?php

class Home extends Controller {
    public function default() {
        if(isset($_COOKIE['token'])){
            AuthCore::checkAuthentication();
        }
        $this->view("main_layout", [
            "Title"=>" Home -  Car Rental",
            "Page"=>"home"
        ],
        "user"); //User hay admin
    }
    function signin()
    {
        AuthCore::onLogin();
        $urls = parse_url($_SERVER['REQUEST_URI']);
        if (isset($urls['query'])) {
            $query = $urls['query'];
            $queryitem = explode('&', $query);
            $get = array();
            foreach ($queryitem as $key => $qi) {
                $r = explode('=', $qi);
                $get[$r[0]] = $r[1];
            }
            $this->googleAuth->handleCallback(urldecode($get['code']));
        }
    }
    public function addUser()
    {
        AuthCore::checkAuthentication();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullname = $_POST['fullname'];
            $fullname = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $this->userModel->create($email, $fullname, $password, "1990-01-01", 1, 1, 1);
            echo $result;
        }
    }
}
?>