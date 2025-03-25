<?php
session_start();
require_once "./mvc/Bridge.php";
$myApp = new App();

// .htaccess
// RewriteEngine On

// RewriteCond %{REQUEST_FILENAME} !-f
// RewriteCond %{REQUEST_FILENAME} !-d
//  RewriteRule ^(.+)$ index.php?url=$1 [L]
?>