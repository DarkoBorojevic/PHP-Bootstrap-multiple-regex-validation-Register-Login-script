<?php

	require_once("connection.php");

	if (isset($_SESSION["id"])) {

		$qUser = "SELECT * FROM users";

		$users = $connection->query($qUser);

		$fUser = $users->fetchAll(PDO::FETCH_OBJ);

	}else{

		session_unset();
		session_destroy();
  		header("Location:index.php");

	}

?>
<div class="col-md-4">
<table class="table table-bordered">
  <thead>
    <tr>
    	<th>User ID</th>
      	<th>Username</th>
      	<th>Email</th>
    </tr>
  </thead>
  <tbody>
  	<tr>
  	<?php

  		if (isset($_SESSION["id"])) {
  			
  			foreach ($fUser as $user) {
			
				echo '
				<tr>
				<td>
					'.$user->id.'
				</td>
				<td>
					<a href="index.php?option=profile&pid='.$user->id.'">
					'.$user->username.'
					</a>
				</td>
				<td>
					'.$user->email.'
				</td>
				</tr>';
			}

  		}else{

  			session_unset();
  			session_destroy();
  			header("Location:index.php");
  		}

	?>
    </tr>
  </tbody>
</table>
</div>