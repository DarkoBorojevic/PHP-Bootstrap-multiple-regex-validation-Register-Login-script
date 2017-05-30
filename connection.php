<?php

	try {

		
		$connection = new PDO ('mysql: host=138.201.223.6; dbname=tipo_data','tipo_darko','jnenox7493ksmie836jjklu');
		
		/*
		$connection = new PDO ('mysql: host=127.0.0.1; dbname=tipo_data','root','');
		*/
		
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	} catch (PDOException $e) {

		echo $e->getMessage();
		die();
	}

?>