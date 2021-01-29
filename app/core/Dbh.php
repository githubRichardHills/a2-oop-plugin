<?php declare(strict_types=1);

	class Dbh{
		private $host="localhost";
		private $user="c9testUser";
		private $pwd="EfpTnh_5hwLLZ";
		private $dbName="c9a1oopp";
		
		protected function connect(){
			$dsn='mysql:host='.$this->host.';dbname='.$this->dbName;
			$pdo=new PDO($dsn,$this->user,$this->pwd);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;
		}
	}