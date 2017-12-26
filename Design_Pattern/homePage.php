<?php
    session_start();
    if(empty($SESSION['akansha@gmail.com'])){
        echo "Login First!";
        die();
    }
	require "mySQLConnection.php";
    $dbDetails=array('dbName'=>'user_login','hostName'=>'localhost','username'=>'root','password'=>'root');
	$mySQLconn = mySQLConnection::connect($dbDetails);
	$sql="select id,title,author,price,quantity from books_info";
	$stmt=$mySQLconn->dbConnection->prepare($sql);
	$stmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
</head>
<body>
	<table align="center" cellpadding="10" cellspacing="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price in Rs</th>
            <th>Price in USD</th>
            <th>Price in Euro</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php while( $row = $stmt->fetch()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><input type="text" name="price_in_rs" value='<?php echo $row['price'];?>'></td>
            <td><input type="text" name="price_in_usd" value='<?php echo $row['price']*0.013;?>'></td>
            <td><input type="text" name="price_in_euro" value='<?php echo $row['price']*0.016;?>'></td>
            <td><?php echo $row['quantity']; ?></td>
        </tr>
        <?php endwhile ?>
    </tbody>
</table>
<form method="post" action="changeCurrency.php">
    <input type="text" name="price_in_rs">
	<input type="submit" name="change" value="Change Currency">
</form>
<form action="login.html" method="post" align="right">
	<input type="submit" name="logout" value="Logout">
	
</form>
<hr>
<h1 align="center">Buy Books</h1>
<form method="post" action="checkout.php">
<label>Available Books :</label>
<select name="selected_title">
<option>Select Book</option>
<?php
	$sql="select title from books_info";
	$stmt=$mySQLconn->dbConnection->prepare($sql);
	$stmt->execute();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		echo '<option>'.$row['title'].'</option>';
	}
?>
</select>
<br>
	<label>Enter Quantity :</label>
	<input type="text" name="quantity"><br>
	<input type="submit" name="checkout" value="Checkout">
</form>
</body>
</html>