<?php
/** Database configuration **/

Class DatabaseConfiguration{
	
	private $dbhost;
	private $dbuser;
	private $dbpass;
	private $dbname;
	
	public function __construct( DataBaseConnect $DBConnect ){
		$this->dbhost = 'localhost';
		$this->dbuser = 'futural';
		$this->dbpass = 'futural';
		$this->dbname = 'futural';
	}
	
	public function getDbHost(){
		return $this->dbhost;
	}
	public function getDbUser(){
		return $this->dbuser;
	}
	public function getDbPass(){
		return $this->dbpass;
	}
	public function getDbName(){
		return $this->dbname;
	}
}
?>