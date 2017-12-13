<?php
	$tmp=$_FILES['upload']['tmp_name'];
	$dst="/home/webonise/php/{$_FILES['upload']['name']}";
	if(move_uploaded_file($tmp,$dst)){
		echo "Successfully uploaded file!";
	}
	else{
		$error=$_FILES['upload']['error'];
		echo $error;
	}
	$error=$_FILES['upload']['error'];
	switch ($error) {
		case '1':
			echo "UPLOAD_ERR_INI_SIZE";
			break;
		case '2':
			echo "UPLOAD_ERR_FORM_SIZE";
			break;
	
		default:
			 echo "UPLOAD_ERR_NO_FILE";
			break;
	}
?>