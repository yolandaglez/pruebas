<?php

	class DB extends PDO {

		function dbConn(){

			$host = 'localhost';
			$dbname = 'thefirstclub';
			$user = 'root';
			$pass = 'root';

			try {

				$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				//$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  

				return $db;
			}

			catch (PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
			}
		}


		function getAll(){

			$db=new DB();

			$sql = "SELECT * FROM movies";
			$st = $db->prepare($sql);
			$st->execute();
			$st->setFetchMode(PDO::FETCH_ASSOC);

			return $st;

		}

	}

	$result = new DB();
	$result->getAll($st);

?>