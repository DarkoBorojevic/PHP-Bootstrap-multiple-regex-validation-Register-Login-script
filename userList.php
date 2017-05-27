<?php

	$qUser = "SELECT * FROM users";

	$users = $connection->query($qUser);

	$fUser = $users->fetchAll(PDO::FETCH_OBJ);

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
	?>
    </tr>
  </tbody>
</table>
</div>