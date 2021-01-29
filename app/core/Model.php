<?php declare(strict_types=1);

class Model extends Dbh {   ### this class must extend Dbh in order to be able to access the connect() method
	
	public function setUser($fn,$ln,$dob){
		$sql="INSERT INTO old_users(users_firstname,users_lastname,users_dateofbirth) VALUES(?,?,?)";
		$stmt=$this->connect()->prepare($sql);
		$stmt->execute([$fn,$ln,$dob]);
		$results=$stmt->fetchAll();
	}

	public function dropUser($id){
		$sql="DELETE FROM old_users WHERE id='".$id."'";
		//$sql="DROP TABLE IF EXISTS users";
		//$sql="CREATE TABLE IF NOT EXISTS users (user_id INT AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(255), user_email VARCHAR(255), password VARCHAR(255))";
		//$sql="ALTER TABLE users users RENAME TO old_users";
		//  \"0\",\"Richard Hills\",\"hills@tokyodiner.com\",\"qTY6Ppp$\"
		//	\"Marjan Szumlicki\",\"ms@pafa.co.uk\",\"V9ncGAn3JNzj\"
		//	\"Alan Alda\",\"aalda@aol.com\",\"yQANE8Yxcjeg\"
		//$sql="INSERT INTO users (user_name,user_email,password) VALUES(\"Zoe Ball\",\"zoe.ball@bbc.co.uk\",\"vmMh28tbwC\")";
		
		
		$stmt=$this->connect()->query($sql);
	}
	
	public function sortAndGetUsers($sortIndex=[]){
		if(!isset($sortIndex[0]))$column='dob'; else $column=$sortIndex[0];
		if(!isset($sortIndex[1]))$direction='ASC'; else $direction=$sortIndex[1];
		
		switch ($column) {
			case 'id':
				$column= "id";
				break;
			case 'fn':
				$column= "users_firstname";
				break;
			case 'ln':
				$column= "users_lastname";
				break;
			default:
				$column= "users_dateofbirth";
				break;
		}
		$sql="SELECT * FROM old_users ORDER BY ".$column." ".$direction;
		$stmt=$this->connect()->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	
	public function getAllUsers(){
		$sql="SELECT * FROM old_users ORDER BY users_lastname";
		$stmt=$this->connect()->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	
}