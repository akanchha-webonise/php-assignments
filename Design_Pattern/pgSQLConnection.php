<?php
	require "database.php";
	class pgSQLConnection implements dbConnection{
		public function connect(){
		 	 $username="postgres";
			 $password="root";
			 $servername="localhost";
			 $dbName="user_login";
			 try{
			 	$pgSQLconn=new PDO("mysql:host=$servername;dbname=$dbName",$username,$password);
			 	$pgSQLconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			 	return $pgSQLconn;
			}
			catch(PDOException $e){
	            echo $e->getMessage();
	        } 
		}	
	}