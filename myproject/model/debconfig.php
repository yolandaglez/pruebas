<?php
	
	$username = 'root';
	$password = 'root';

	$dsn = 'mysql:host=localhost;dbname=thefirstclub';

	$db = new PDO(
		$dsn,
		$username,
		$password,
		array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));

	$sql = 'SELECT * FROM ebooks ';

	$statement = $db->prepare($sql);

	$statement->execute();

	$statement->setFetchMode(PDO::FETCH_ASSOC);

	return $statement;


?>