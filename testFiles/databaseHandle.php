<?php
//namespace PHPUnit\Framework\TestCase;
abstract class dbConnection{
	 abstract public static function connect();
}

class mySQLConnection extends dbConnection{
	private $username=null,$password=null,$servername=null,$dbName=null;
	public $dbConnection=null;
	private static $instance=null;
	private function __construct(){
		 $this->username="root";
		 $this->password="root";
		 $this->servername="localhost";
		 $this->dbName="shoppingCartApi";
		 try{
		 	$this->dbConnection=new PDO('mysql:host='.$this->servername.';dbname='.$this->dbName,$this->username,$this->password);
		}
		catch(PDOException $e){
            echo $e->getMessage();
        } 
	}
	public static function connect(){
		if(self::$instance==null){
		 	self::$instance=new mySQLConnection();
		 }
		  return self::$instance;
	}	
}

?>