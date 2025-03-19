<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["Title"] ?></title>
	<?php
		if($web == "user"){
			echo '
	<link rel="icon" type="image/png" href="../../public/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../../public/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../public/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="../../public/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../../public/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../../public/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="../../public/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../../public/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="../../public/css/util.css">
	<link rel="stylesheet" type="text/css" href="../../public/css/auth.css">';
		}else{
			echo '
			<link rel="stylesheet" id="css-main" href="../../public/css/dashmix.min.css">
			';
		}
?>
</head>
<body>
<?php

    if ($data['Page'] == "error/404" || $data['Page'] == "error/403") {
        include "./mvc/views/" .$data['Page'].".php";
    } else{
        	include "./mvc/views/". $web ."/" .$data['Page'].".php" ;
    }
    ?> 
	<!--===============================================================================================-->
	<script src="../../public/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="../../public/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
		<script src="../../public/vendor/bootstrap/js/popper.js"></script>
		<script src="../../public/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="../../public/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<script src="../../public/vendor/daterangepicker/moment.min.js"></script>
		<script src="../../public/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
		<script src="../../public/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
		<script src="../../public/js/auth.js"></script>
</body>
</html>