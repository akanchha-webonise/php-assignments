<?php
	require "database.php";
	class mySQLConnection extends dbConnection{
		private $username=null,$password=null,$servername=null,$dbName=null;
		public $dbConnection=null;
		private static $instance=null;
		private function __construct($dbDetails=array()){
			 $this->dbName=$dbDetails['dbName'];
			 $this->servername=$dbDetails['hostName'];
			 $this->username=$dbDetails['username'];
			 $this->password=$dbDetails['password'];
			 try{
			 	$this->dbConnection=new PDO('mysql:host='.$this->servername.';dbname='.$this->dbName,$this->username,$this->password);
			}
			catch(PDOException $e){
	            echo $e->getMessage();
	        } 
		}
		public static function connect($dbDetails=array()){
			 if(self::$instance==null){
			 	self::$instance=new mySQLConnection($dbDetails);
			 }
			 return self::$instance;
		}	
	}
?>