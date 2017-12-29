<?php
header("Content-Type:application/json");
$method=$_SERVER['REQUEST_METHOD'];
method_api($method);
function method_api($method){
		//$inventory=array("Television"=>"20000","Fridge"=>"40000","Mobile"=>"10000","Bottle"=>"250");
		if($method=='GET'){
			$url=$_SERVER["REQUEST_URI"];
			$uri=basename($url);
			$new_inventory=array(file_get_contents("data.json"));
			echo json_encode($new_inventory);
			$price = get_price($uri);
			if(empty($price)){
				echo "\nProduct Not Found";
			}
			else{
				echo "\nProduct Found".$price;
			}
			echo array_sum($new_inventory);
			//echo "\n Total Sum:".$total;
						
		}
		else if($method=='POST'){
			$inventory=array(file_get_contents("data.json"));
			$new_inventory=array_merge($inventory,$_POST);
			print_r($new_inventory);
			file_put_contents("data.json",json_encode($new_inventory));
		}
		else if($method=='PUT'){
			$inventory=array(file_get_contents("data.json"));
	        parse_str(file_get_contents("php://input"),$post_vars);
			$put_inventory=array_replace_recursive($inventory,$post_vars);
			echo json_encode($put_inventory);
			file_put_contents("data.json",json_encode($put_inventory));
		}
		else if($method=='DELETE'){
			$inventory=array(file_get_contents("data.json"));
			$url=$_SERVER["REQUEST_URI"];
			$uri=basename($url);
			unset($inventory[$uri]);
			echo json_encode($inventory);
			file_put_contents("data.json",json_encode($inventory));
		}

	}

	function get_price($name)
	{
		$inventory=json_decode(file_get_contents("data.json"));
		foreach($inventory as $product=>$price)
		{
			if($product==$name)
			{
				return $price;
				break;
			}
		}
	}	

?>

