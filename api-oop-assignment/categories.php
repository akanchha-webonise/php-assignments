<?php
require "databaseHandle.php";

class categories{
	private $mySQLconn;
	/**
 	* @codeCoverageIgnore
 	*/
	public function __construct(){
		$this->mySQLconn = mySQLConnection::connect();
	}
	public function AddCategory($post_id,$post_name,$post_description,$post_tax){
		$sql="insert into categories(id,name,description,tax)values(:id,:name,:description,:tax)";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':id',$post_id);
 		$stmt->bindParam(':name',$post_name);
 		$stmt->bindParam(':description',$post_description);
 		$stmt->bindParam(':tax',$post_tax);
 		$result=$stmt->execute();
 		if(1==$result)
 			echo "Category Added";
 		else 
 			echo "Unable to add Category";
	}	
	public function displayCategory(){
		$sql="select * from categories";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			$result[]=$row;
		}
		echo json_encode($result);
	}
	public function updateCategory($putTax,$putId){	
		$sql="update categories set tax=:put_tax where id=:put_id";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':put_tax',$putTax);
 		$stmt->bindParam(':put_id',$putId);
 		$result=$stmt->execute();
	}
	public function deleteCategory($deleteId){
		$sql="delete from categories where id=:delete_id";
		$stmt=$this->mySQLconn->dbConnection->prepare($sql);
		$stmt->bindParam(':delete_id',$deleteId);
		$result=$stmt->execute();
	}
}
$method=$_SERVER['REQUEST_METHOD'];
$category=new categories();
if($method=='POST'){
		$category->AddCategory($_POST['id'],$_POST['name'],$_POST['description'],$_POST['tax']);
}
else if($method=='GET'){
		$category->displayCategory();
}
else if($method=='PUT'){
		parse_str(file_get_contents("php://input"),$put_vars);
		$category->updateCategory($put_vars['tax'],$put_vars['id']);
}
else if($method=='DELETE'){
		parse_str(file_get_contents("php://input"),$delete_vars);
		$category->deleteCategory($delete_vars['id']);
}
?>

