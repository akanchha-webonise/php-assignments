<?php
require "databaseHandle.php";
class carts{
	private $mySQLconn;
	/**
 	* @codeCoverageIgnore
 	*/
	public function __construct(){
		$this->mySQLconn = mySQLConnection::connect();
	}
	public function AddToCart($post_id,$product_id){
		$sql="insert into carts_products(cart_id,product_id) values(:id,:product_id)";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':id',$post_id);
		$stmt->bindParam(':product_id',$product_id);
 		$stmt->execute();	
	}	
	public function displayCart(){
		$sql="insert into carts(id,total,total_discount,total_with_discount,total_tax,grand_total) select cart_id,sum(products.price),sum((products.discount*products.price)/100),sum(products.price)-sum((products.discount*products.price)/100),sum((categories.tax*products.price)/100),sum(products.price)-sum((products.discount*products.price)/100)+sum((categories.tax*products.price)/100) from products,carts_products,categories where carts_products.product_id=products.id and products.id=categories.id group by cart_id";
 		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
 		$stmt->execute();
		$sql="select * from carts";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			$result[]=$row;
		}
		echo json_encode($result);
	}
	public function deleteCart($deleteId){
		$sql="delete from carts where id=:delete_id";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':delete_id',$deleteId);
		$stmt->execute();
		$sql="delete from carts_products where cart_id=:delete_id";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':delete_id',$delete_vars['id']);
		$stmt->execute();

	}
}

	$cart=new carts();
	$method=$_SERVER['REQUEST_METHOD'];
	if($method=='POST'){
			$cart->AddToCart($_POST['cart_id'],$_POST['product_id']);
	}
	else if($method=='GET'){
			$cart->displayCart();
	}
	else if($method=='DELETE'){
		parse_str(file_get_contents("php://input"),$delete_vars);
			$cart->deleteCart($delete_vars['id']);
	}



?>