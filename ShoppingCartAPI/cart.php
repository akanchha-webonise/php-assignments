<?php
header("Content-Type:application/json");
$method=$_SERVER['REQUEST_METHOD'];
method_api($method);
function method_api($method){
		//$cart=array("Television"=>"20000","Fridge"=>"40000","Mobile"=>"10000","Bottle"=>"250");
		if($method=='GET'){
			$url=$_SERVER["REQUEST_URI"];
			$uri=basename($url);
			$new_cart=array(file_get_contents("data.json"));
			print_r($new_cart);
			$price = get_price($uri);
			if(empty($price))
			{
				echo "\nProduct Not Found";
			}
			else
			{
				echo "\nProduct Found".$price;
			}
						
		}
		else if($method=='POST'){
			$cart=array(file_get_contents("data.json"));
			$new_cart=array_merge($cart,$_POST);
			print_r($new_cart);
			file_put_contents("data.json",json_encode($new_cart));
		}
		else if($method=='PUT'){
			$cart=array(file_get_contents("data.json"));
	        parse_str(file_get_contents("php://input"),$post_vars);
			$put_cart=array_replace_recursive($cart,$post_vars);
			echo json_encode($put_cart);
			file_put_contents("data.json",json_encode($put_cart));
		}
		else if($method=='DELETE'){
			$cart=array(file_get_contents("data.json"));
			$url=$_SERVER["REQUEST_URI"];
			$uri=basename($url);
			unset($cart[$uri]);
			echo json_encode($cart);
			file_put_contents("data.json",json_encode($cart));
		}

	}

	function get_price($name)
	{
		$carts=json_decode(file_get_contents("data.json"));
		foreach($carts as $product=>$price)
		{
			if($product==$name)
			{
				return $price;
				break;
			}
		}
	}	

?>

