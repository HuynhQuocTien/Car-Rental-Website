<?php include "./mvc/views/user/inc/head.php"; ?>

<body>
    <div id="page-container"
        class="sidebar-o sidebar-dark sidebar-mini enable-page-overlay side-scroll page-header-dark" style="
    padding: 0;
">
        <?php include "./mvc/views/user/inc/header.php"; ?>
        <!-- Main Container -->
        <main id="main-container">

            <?php include "./mvc/views/user/inc/navbar.php"; ?>
            <?php include "./mvc/views/user/".$data['Page'].".php"; ?>
        </main>
        <!-- END Main Container -->
        <?php include "./mvc/views/user/inc/footer.php"; ?>
    </div>
    <?php include "./mvc/views/user/inc/script.php"; ?>
</body>

</html>