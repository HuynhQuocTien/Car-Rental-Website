
<?php 
function UrlProcess(){
    if (isset($_GET["url"])) {
        return explode("/", filter_var(trim($_GET["url"], "/")));
    }
    return null;
}
$arrr = UrlProcess();
 if($arrr[0] == "user"){
    require "./mvc/views/user/inc/head.php" ;

    echo '<body>';
    include "./mvc/views/user/inc/navbar.php";

    include "./mvc/views/user/".$data['Page'].".php";

    include "./mvc/views/user/inc/chat.php";

    include "./mvc/views/user/inc/footer.php";

    echo '<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>';
    include "./mvc/views/user/inc/script.php";
echo '</body>
</html>';
 } else if($arrr[0] == "admin"){
    // include "./mvc/views/admin/inc/config.php";
    require "./mvc/views/admin/inc/head.php";
    echo '<body id="page-top">
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">';
    require "./mvc/views/admin/inc/header.php";
    require "./mvc/views/admin/inc/navbar.php";
    echo '<main id="main-container">';
    include "./mvc/views/admin/".$data['Page'].".php" ;
    echo '</main>';
    require "./mvc/views/admin/inc/footer.php";
    echo '</div>';
    require "./mvc/views/admin/inc/script.php";
    echo '</body>
    </html>';
 }
?>

