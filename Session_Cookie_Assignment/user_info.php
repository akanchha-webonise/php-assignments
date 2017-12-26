<?php
session_start();
if(empty($SESSION['akansha@gmail.com'])){
	echo "Login First!";
	die();
}
$selected_database=$_POST['option_selected'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
if("mysql"==$selected_database){
	 $username="root";
	 $password="root";
	 $servername="localhost";
	 try{
	 	$conn=new PDO("mysql:host=$servername;dbname=user_details",$username,$password);
	 	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	 }
	catch(PDOException $e){
 		echo "Connection failed: ".$e->getMessage();
 	}
}
else if("pgsql"==$selected_database){
	$username="postgres";
	$password="root";
	$servername="localhost";
	try{
		$conn=new PDO("pgsql:host=$servername;dbname=user_details",$username,$password);
	 	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
 		echo "Connection failed: ".$e->getMessage();
 	}

}
$sql="insert into user_info(first_name,last_name) values(:first_name , :last_name)";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':first_name',$first_name);
$stmt->bindParam(':last_name',$last_name);
$stmt->execute();
header("Location:http://example.com/Session_Cookie_Assignment/homepage.html");


?>
