<?php

class HomeController {
    public function index() {
        // Load the home view
        require_once '../views/home.php';
    }

    public function about() {
        // Load the about view
        require_once '../views/about.php';
    }

    public function contact() {
        // Load the contact view
        require_once '../views/contact.php';
    }
}
?>
