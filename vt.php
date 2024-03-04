<?php

	
	$dbName = 'hukukdb';
	$dbUser = 'hukukdbu';
	$dbPass = 'Law123*--';
	$dbHost = 'localhost';

	$dsn = 'mysql:host='.$dbHost.';dbname='.$dbName;	
	try {
		$db = new PDO($dsn, $dbUser, $dbPass);
		$db->query("SET CHARACTER SET utf8");
	} catch (PDOException $e) {
		//echo 'Connection failed: ' . $e->getMessage();
		echo 'Baglanti Hatasi!';
	}


	?>