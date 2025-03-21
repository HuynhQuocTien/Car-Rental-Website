<?php 
function UrlProcess(){
    if (isset($_GET["url"])) {
        return explode("/", filter_var(trim($_GET["url"], "/")));
    }
    return null;
}
$arrr = UrlProcess();
if ($web != $arrr[0]) {
    include "./mvc/views/error/404.php";
    exit();
}

include "./mvc/views/".$web ."/inc/head.php"; 

?>

<body>
    <?php 
        if($arrr[0] == "user"){
            echo '<div id="page-container"
        class="sidebar-o sidebar-dark sidebar-mini enable-page-overlay side-scroll page-header-dark" style="
    padding: 0;">';
        } else if($arrr[0] == "admin"){
            echo '<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">';
        }
    ?>

    <?php 
         if($arrr[0] == "admin"){
            include "./mvc/views/admin/inc/navbar.php"; 
       }
        include "./mvc/views/".$web ."/inc/header.php"; ?>
    <!-- Main Container -->
    <main id="main-container">

        <?php if($arrr[0] == "user"){
                 include "./mvc/views/user/inc/navbar.php"; 
            }
            include "./mvc/views/" .$web ."/".$data['Page'].".php"; ?>
    </main>
    <!-- END Main Container -->
    <?php include "./mvc/views/".$web ."/inc/footer.php"; ?>
    </div>
    <?php include "./mvc/views/".$web."/inc/script.php"; ?>
</body>

</html>