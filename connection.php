<?php

	try {

		
		$connection = new PDO ('mysql: host=ip address; dbname=database','root','');
		
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	} catch (PDOException $e) {

		echo $e->getMessage();
		die();
	}

?>