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
<?php

	$err = "";

	if (isset($_POST["login"])) {

		/***************************************/
		if (!empty($_POST["username"])) {

			$qUserName = "SELECT * FROM users WHERE username = :username";

			$users = $connection->prepare($qUserName);

			$users->execute(array(

				':username'=>$_POST["username"]

			));

		if ($users->rowCount()==1) {

				//username postoji i jedan je u bazi
				
			}elseif($users->rowCount()>=2) {
				
				$err .= "There has been a mistake, please contact admin!<br>";

			}else{

				$err .= "Username does not exist, please register first!<br>";
		}
			
		}else{

			$err .= "Fill Username!<br>";
		}
 
		/***************************************/

		if (!empty($_POST["pass"])) {

			if (isset($_POST["username"])) {
				
				$qAccount = "SELECT * FROM users WHERE username = :username AND password = :pass";
			}

			$users = $connection->prepare($qAccount);

			$users->execute(array(

				':username'=>$_POST["username"],
				':pass'=>$_POST["pass"]

			));
			
			if ($users->rowCount()==1) {

				$qLog = $users->fetchAll(PDO::FETCH_OBJ);

				foreach ($qLog as $account) {
					$hash = $account->password;
					$order = $account->id;
				}

			}elseif($users->rowCount()>=2) {
				
				$err .= "There has been a mistake please contact admin!<br>";

			}else{

				$err .= "That password doesn't exist!<br>";
			}

	
		}else{

			$err .= "Fill Password!<br>";
		}
		/***************************************/
		if ($err == "") {

			$_SESSION['id'] = $order;

			header("Location:index.php");

		}else{

			echo 
			'<div class="col-md-12">
			<br>
			<div class="alert alert-danger" role="alert">
			'.$err.'
			</div>
			</div>';
		}
	}

	

?>
<br>
<form method="post" action="index.php?option=login">
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
			<td colspan="2">
				<input class="btn btn-default" type="submit" name="login" value="login">
			</td>
		</tr>
	</table>
</form>
</div>
</body>
</html>