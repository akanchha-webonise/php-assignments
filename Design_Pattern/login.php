<?php

	require "mySQLConnection.php";
	$userName = $_POST['user_name'];
	$password = $_POST['password'];
	try{
		$dbDetails=array('dbName'=>'user_login','hostName'=>'localhost','username'=>'root','password'=>'root');
		$mySQLconn = mySQLConnection::connect($dbDetails);
		$sql ="select id from login_details where name=:username and password=:password";
		$stmt=$mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':username',$userName);
 		$stmt->bindParam(':password',$password);
 		$stmt->execute();
		if(1==$stmt->rowCount()){
			session_start();
			$_SESSION["username"] = $_POST['user_name'];
			header("Location:http://example.com/Design_Pattern/homePage.php");
		}
		else{
			header("Location:http://example.com/Design_Pattern/login.html");
		}	
	}catch (Exception $e) {
    	echo 'Exception: ',  $e->getMessage(), "\n";
	}
?>


