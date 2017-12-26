<?php
session_start();
if(empty($SESSION['akansha@gmail.com'])){
	echo "Login First!";
	die();
}
$selected_database=$_POST['option_selected'];
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
    $sql = $conn->prepare("SELECT id,first_name,last_name FROM user_info") ; 
    $sql->execute() ;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
    </thead>
    <tbody>
        <?php while( $row = $sql->fetch()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
        </tr>
        <?php endwhile ?>
    </tbody>
</table>
<form action="homepage.html" method="post">
	<input type="submit" name="back_button" value="Back">
</form>
</body>
</html>


