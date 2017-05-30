<?php
	session_start();
	unset($_SESSION["id"]);
	session_destroy();
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Login</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<style type="text/css">
		* {
			font-family: tahoma, sans-serif;
		}
		</style>
	</head>

<body>

<div class="container">
	<br>
	<div class="col-md-6">
		<a class="btn btn-primary" href="index.php">home</a>
		<a class="btn btn-success" href="index.php?option=register">register</a>
		<a class="btn btn-default" href="index.php?option=login">login</a>
	</div>
	<br><br>

	<?php

		if (isset($_GET['option'])) {
			$file = $_GET['option'].".php";
				if (file_exists($file)) {
					require_once($file);
				}else{
					echo '<br>
					<div class="col-md-12">
					<div class="alert alert-danger" role="alert">
					That page doesn\'t exist! Go back to <a href="index.php">homepage!
					</div>
					</div>';
				}
		}
	?>

	<div class="col-md-12">
		<br>
		<div class="alert alert-success" role="alert">You are logged out!</div>
	</div>
</div>

</body>
</html>

