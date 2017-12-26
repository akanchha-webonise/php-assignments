<?php
	require "mySQLConnection.php";
	$selected_title=$_POST['selected_title'];
	$quantity=$_POST['quantity'];
	echo "-----Bill-----"."<br>";
	$dbDetails=array('dbName'=>'user_login','hostName'=>'localhost','username'=>'root','password'=>'root');
	$mySQLconn = mySQLConnection::connect($dbDetails);
	echo "Name of book :".$_POST['selected_title']."<br>";
	echo "Quantity: ".$_POST['quantity']."<br>";
	$sql="select price,quantity from books_info where title=:title";
	$stmt=$mySQLconn->dbConnection->prepare($sql);
	$stmt->bindParam(':title',$selected_title);
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($row['quantity']>$quantity){
	
		echo "Price:".$row['price']*$quantity;
		$new_quantity=$row['quantity']-$quantity;
		$sql="update books_info set quantity=:quant where title=:title";
		$stmt=$mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':quant',$new_quantity);
		$stmt->bindParam(':title',$selected_title);
		$stmt->execute();
	}
	else{
		echo "Quantity Not available";
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bill</title>
</head>
<body>
<form action="homePage.php" method="post">
	<input type="submit" name="back" value="Back">	
</form>

</body>
</html>
