<?php
require "databaseHandle.php";
class products{
	private $mySQLconn;
	/**
 	* @codeCoverageIgnore
 	*/
	public function __construct(){
		$this->mySQLconn = mySQLConnection::connect();
	}
	public function AddProduct($post_id,$post_name,$post_description,$post_price,$post_discount,$post_categoryId){
		$sql="insert into products(id,name,description,price,discount,category_id)values(:id,:name,:description,:price,:discount,:category_id)";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':id',$post_id);
 		$stmt->bindParam(':name',$post_name);
 		$stmt->bindParam(':description',$post_description);
 		$stmt->bindParam(':price',$post_price);
 		$stmt->bindParam(':discount',$post_discount);
 		$stmt->bindParam(':category_id',$post_categoryId);
 		$result=$stmt->execute();
 		if(1==$result)
 			echo "Product Added";
 		else 
 			echo "Unable to add Product";
	}	
	public function displayProduct(){
		$sql="select * from products";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->execute();
		while($row=$stmt->fetch()){
			$result[]=$row;
		}
		echo json_encode($result);
	}
	public function updateProduct($putDiscount,$putId){
		$sql="update products set discount=:put_discount where id=:put_id";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':put_discount',$putDiscount);
 		$stmt->bindParam(':put_id',$putId);
 		$stmt->execute();

	}
	public function deleteProduct($deleteId){
		$sql="delete from products where id=:delete_id";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':delete_id',$deleteId);
		$stmt->execute();

	}

}
$product=new products();
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST'){
		$product->AddProduct($_POST['id'],$_POST['name'],$_POST['description'],$_POST['price'],$_POST['discount'],$_POST['categoryId']);
}
else if($method=='GET'){
		$product->displayProduct();
}
else if($method=='PUT'){
		parse_str(file_get_contents("php://input"),$put_vars);
		$product->updateProduct($put_vars['discount'],$put_vars['id']);
}
else if($method=='DELETE'){
		parse_str(file_get_contents("php://input"),$delete_vars);
		$product->deleteProduct($delete_vars['id']);
}

?>