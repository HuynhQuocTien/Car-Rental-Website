
<?php require "./mvc/views/user/inc/head.php" ?>

<body>
    <?php 
    include "./mvc/views/user/inc/navbar.php";
    ?>

    <?php
    include "./mvc/views/user/".$data['Page'].".php" 
    ?>     
    <?php include "./mvc/views/user/inc/chat.php"; ?>
    <?php
    include "./mvc/views/user/inc/footer.php";
    ?>
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
    <?php
        include "./mvc/views/user/inc/script.php";
    ?>
</body>

</html>