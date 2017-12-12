<?php
		require_once "convertPrice.php";
		require_once "usd.php";
		require_once "euro.php";
		require  "mySQLConnection.php";
		$dbDetails=array('dbName'=>'user_login','hostName'=>'localhost','username'=>'root','password'=>'root');
		$mySQLconn = mySQLConnection::connect($dbDetails);
		$getPrice=$_POST['price_in_rs'];
		//$sql="select price from books_info where title='Let us C'";
		//$stmt=$mySQLconn->dbConnection->prepare($sql);
		//$stmt->execute();
		//$row=$stmt->fetch(PDO::FETCH_ASSOC);
		//$price=$row['price'];
		$price=$getPrice;
		echo $price;
		$convertPrice = new convertPrice();
		$usd=new USD($price);
		$euro=new EURO($price);
		$convertPrice->addCurrency($usd);
		$convertPrice->addCurrency($euro);
		$check=$convertPrice->updatePrice();
		$sql="update books_info set price=:price where title='Let us C'";
		$stmt=$mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':price',$price);
		$stmt->execute();

?>