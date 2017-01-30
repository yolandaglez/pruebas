<?php
	
	class Connection{

		private $driver;
		private $host, $user, $pass, $database;

		public function __construct(){

			$db_config = require_once '../config/database.php';
			$this->driver=$db_config['driver'];
			$this->host=$db_config['host'];
			$this->user=$db_config['user'];
			$this->pass=$db_config['pass'];
			$this->database=$db_config['database'];
		}

		//connection db
		public function connection(){

			if($this->driver === 'mysql' || $this->driver == null){
				$conn = new mysqli($this->host, $this->user, $this->pass, $this->database);
				
			}
			else {
				echo "error";
			}
		}

			
			
	}

	$connect = new Connection();
	$connect->connection();

?>