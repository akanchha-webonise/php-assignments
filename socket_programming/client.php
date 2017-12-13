<?php
$uploaddir="/home/webonise/php/{$_FILES['file_contents']['name']}";

if(move_uploaded_file($_FILES['file_contents']['tmp_name'],$uploaddir)){
	echo "success\n";
}
else{
	$error=$_FILES['file_contents']['error'];
	echo $error;
}
echo "Status Code:\n";
$get_http_code=http_response_code();
switch ($get_http_code) {
	case '200':
		echo "Successful!";
		break;
	case '500':
		echo "Internal Server Error!";
		break;
	case '400':
		echo "Bad Request!";
		break;
	case '404':
		echo "Request Not Found!";
		break;
	default:
		echo "Error";
		break;
}


?>