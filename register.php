<!DOCTYPE html>
<html>

	<head>
		<title>Register</title>
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
<?php

	$err = "";

	if (isset($_POST["submit"])) {
		
		if (!empty($_POST["username"])) {

			$qUsername ="SELECT * FROM users WHERE username = :username";
			$users = $connection->prepare($qUsername);
			$users->execute(array(

				':username'=>$_POST['username']

				));

			if ($users->rowCount()) {
				
				$err .= "That Username is taken!<br>";

			}else{


				if (strlen($_POST["username"]) > 14) {
					
					$err .= "Username can be 14 characters maximum!<br>";

				}


				if (!preg_match("/^[\w .]+$/", $_POST["username"])) {
					
					$err .= "Username can be letters an numbers only!<br>";

				}else{

					$username = $_POST["username"];

				}
			}
			
		}else{

			$err .= "Fill Username!<br>";
		}

		/***************************************/

		if (!empty($_POST["pass"])) {


			if (!empty($_POST["repass"])) {
				

			}else{

				$err .= "Fill repeat Password!<br>";

			}
			
		}else{

			$err .= "Fill Password!<br>";
		}

		/***************************************/

		if (!empty($_POST["pass"]) && !empty($_POST["repass"])) {

			if ($_POST["pass"] == $_POST["repass"]) {

				
				if (strlen($_POST["pass"]) < 16) {
					
					$err .= "Password must be at least 16 characters long!<br>";

				}

				if (strlen($_POST["pass"]) > 34) {
					
					$err .= "Password can be 34 characters maximum!<br>";

				}

				if (!preg_match("/^[^<>$*]+$/", $_POST["pass"])) {
					
					$err .= "Password can't have symbols <,>,* or $ in it!<br>";

				}else{

					if (!preg_match("/[0-9][A-Z]/", $_POST["pass"])) {
						
						$err .= "Password must contain a number and at least one uppercase letter in it!<br>";

					}else{

						$password = $_POST["pass"];

					}

				}

			}else{

				$err .= "Passwords don't match!<br>";

			}
			
		}

		/***************************************/

		if (!empty($_POST["name"])) {

			if (strlen($_POST["name"]) > 24) {
					
				$err .= "Name can be 24 characters maximum!<br>";

			}

			if (!preg_match("/^[\w .]+$/", $_POST["name"])) {
				
				$err .= "Name can be letters an numbers only!<br>";

			}else{

				$name = $_POST["name"];

			}
			
		}else{

			$err .= "Fill Name!<br>";

		}

		/***************************************/

		if (!empty($_POST["email"])) {

			$qEmail ="SELECT * FROM users WHERE email = :email";
			$users = $connection->prepare($qEmail);
			$users->execute(array(

				':email'=>$_POST['email']

				));

			if ($users->rowCount()) {
				
				$err .= "That Email is taken!<br>";

			}else{

				if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					
					$err .= "Please enter proper E-mail address!<br>";

				}else{

					$email = $_POST["email"];

				}

			}
			
		}else{

			$err .= "Fill Email!<br>";
		}

		/***************************************/

		if (!$err == "") {
			
			echo 
			'<div class="col-md-12">
			<br>
			<div class="alert alert-danger" role="alert">
			'.$err.'
			</div>
			</div>';

		}else{

			$qk = "INSERT INTO users SET username= :username,
										password= :password,
										name= :name,
										email= :email";

			$k = $connection->prepare($qk);
			$k->execute(array(

				':username'=> $username,
				':password'=> $password,
				':name'=> $name,
				':email'=> $email

				));

			echo '
			<div class="container">
			<br>
			<div class="col-md-12">
			<br>
			<div class="alert alert-success" role="alert">Registration was a success! 
			You can login now and continue to Your profile!</div>
			</div>
			</div>';

		}

	}

?>
<br>
<form method="post" action="index.php?option=register">
	<table>
		<tr>
			<td>
				Username
			</td>

			<td>
				<input class="form-control" type="text" name="username" required>
			</td>
		</tr>

		<tr>
			<td>
				Password
			</td>

			<td>
				<input class="form-control" type="password" name="pass" required>
			</td>
		</tr>

		<tr>
			<td>
				Repeat password
			</td>

			<td>
				<input class="form-control" type="password" name="repass" required>
			</td>
		</tr>

		<tr>
			<td>
				Name
			</td>

			<td>
				<input class="form-control" type="text" name="name" required>
			</td>
		</tr>

		<tr>
			<td>
				Email
			</td>

			<td>
				<input class="form-control" type="email" name="email" required>
			</td>
		</tr>

		<tr>
			<td colspan="2">
				<input class="btn btn-success" type="submit" name="submit" value="register">
			</td>
		</tr>
	</table>
</form>
</div>
</body>
</html>
