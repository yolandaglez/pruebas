<?php

	require_once 'db.class.php';

	class Results{


		function getAll(){

			$db=new DB();

			$sql = "SELECT * FROM movies";
			$st = $db->prepare($sql);
			$st->execute();
			$st->setFetchMode(PDO::FETCH_ASSOC);

			return $st;

		}
	}

	$result = new Results();
	$result->getAll();
?>