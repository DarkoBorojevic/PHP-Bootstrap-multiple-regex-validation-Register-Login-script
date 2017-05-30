<?php

	require_once("connection.php");

	if (isset($_GET['pid'])) {
		
		//profile of another registered user
		$qUser = "SELECT * FROM users WHERE id= :user";
		$profile = $connection->prepare($qUser);
		$profile->execute(array(
			":user" => $_GET['pid']
		));

	}else{

		//personal profile of logged user
		$qUser = "SELECT * FROM users WHERE id= :user";
		$profile = $connection->prepare($qUser);
		$profile->execute(array(
			":user" => $_SESSION['id']
		));
	}

	if (isset($_SESSION['id'])) {

		if ($profile->rowCount()) {

			//profile interface
			$fetchProfile = $profile->fetchAll(PDO::FETCH_OBJ);

			foreach ($fetchProfile as $p) {
				echo '<div class="col-md-6">';
				echo '<h3 style="color:#0033cc;">'.$p->username.'</h3>';
				echo '<h3 style="color:#000;">'.$p->name.'</h3>';
				echo '<h3 style="color:#000;">'.$p->email.'</h3>';
				echo '</div>';
			}
			
		}else{
			echo '<br>
			<div class="col-md-12">
			<p style="color:#ff0000;">User you are looking for doesn\'t exist!</p>
			</div>';
		}

	}else{
		echo '<br>
		<div class="col-md-12">
		<p style="color:#ff0000;">You don\'t have permission to see that page if you are not registered!</p>
		</div>';
	}
	

?>