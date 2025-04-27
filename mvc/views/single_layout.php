<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["Title"] ?></title>
	<?php
		if($web == "user"){
			echo '
		<link rel="icon" type="image/png" href="'.BASE_URL.'/public/images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="'.BASE_URL.'/public/css/bootstrap.min.css">';
		}else{
			echo '
			    <script>
				 	const BaseUrl = "'.BASE_URL .'/admin/";	
				</script>
			<link rel="stylesheet" id="css-main" href="'.BASE_URL.'/public/css/dashmix.min.css">
			<script src="'.BASE_URL.'/public/js/dashmix.app.min.js"></script>
			<script src="'.BASE_URL.'/public/js/jquery-3.2.1.min.js"></script>
			';
		}
?>
</head>
<?php

    if ($data['Page'] == "error/404" || $data['Page'] == "error/403") {
        include "./mvc/views/" .$data['Page'].".php";
    } else{
        	include "./mvc/views/". $web ."/" .$data['Page'].".php" ;
    }
    ?>

<?php
		if($web == "user"){
			echo '
		<script src="'.BASE_URL.'public/vendor/animsition/js/animsition.min.js"></script>
		<script src="'.BASE_URL.'public/vendor/bootstrap/js/popper.js"></script>
		<script src="'.BASE_URL.'public/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="'.BASE_URL.'public/vendor/select2/select2.min.js"></script>
		<script src="'.BASE_URL.'public/vendor/daterangepicker/moment.min.js"></script>
		<script src="'.BASE_URL.'public/vendor/daterangepicker/daterangepicker.js"></script>
		<script src="'.BASE_URL.'public/vendor/countdowntime/countdowntime.js"></script>';
		}else{
			echo '
			   	 <script src="'.BASE_URL.'/public/js/dashmix.app.min.js"></script>
   				 <script src="'.BASE_URL.'/public/js/plugins/jquery-validation/jquery.validate.min.js"></script>
				<script src="'.BASE_URL.'/public/js/plugins/bootstrap-notify/bootstrap-notify.js"></script>';
		}
		if(isset($data["Script"]) && $web == "admin") {
			echo '<script src="' .BASE_URL.'/public/js/pages/admin/'.$data["Script"].'.js"></script>';
		}
?>
</body>
</html>