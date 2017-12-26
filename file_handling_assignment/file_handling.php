<?php
	if(isset($_POST['create_a_file'])){
		createFile();
	}
	if(isset($_POST['write_a_file'])){
		writeFile();
	}
	if(isset($_POST['read_a_file'])){
		readAFile();
	}
	if(isset($_POST['append_a_file'])){
		appendAFile();
	}
	if(isset($_POST['upload_read_button'])){
		uploadAndRead();
	}
	if(isset($_POST['upload_write_button'])){
		uploadAndWrite();
	}
	if(isset($_POST['upload_append_button'])){
		uploadAndRead();
	}
	function uploadAndRead(){
		$filename=$_FILES['upload']['name'];
		$tmp=$_FILES['upload']['tmp_name'];
		$dst="/home/webonise/php/{$_FILES['upload']['name']}";
		if(move_uploaded_file($tmp,$dst)){
			$myfile=fopen($filename,"r");
			echo fread($myfile,filesize("$filename"));
			fclose($myfile);
		}
		else{
			$error=$_FILES['upload']['error'];
			echo $error;
		}
	}
	function uploadAndWrite(){
		$filename=$_FILES['upload']['name'];
		$tmp=$_FILES['upload']['tmp_name'];
		$dst="/home/webonise/php/{$_FILES['upload']['name']}";
		if(move_uploaded_file($tmp,$dst)){
			$myfile=fopen($filename,"w");
			$txt=$_POST["data_input"];
			fwrite($myfile,$txt);
			fclose($myfile);
		}
		else{
			$error=$_FILES['upload']['error'];
			echo $error;
		}
	}
	function uploadAndAppend(){
		$filename=$_FILES['upload']['name'];
		$tmp=$_FILES['upload']['tmp_name'];
		$dst="/home/webonise/php/{$_FILES['upload']['name']}";
		if(move_uploaded_file($tmp,$dst)){
			$myfile=fopen($filename,"a");
			$txt=$_POST["data_input"];
			fwrite($myfile,$txt);
			fclose($myfile);
		}
		else{
			$error=$_FILES['upload']['error'];
			echo $error;
		}
	}
	function appendAFile(){
		$name=$_POST["input_file_name"];
		if(!file_exists("$name.txt")){  //Error Handling
			die("File not found!");
		}
		else{
			$myfile=fopen("$name.txt","a");
			$txt=$_POST["data_input"];
			fwrite($myfile,"\n".$txt);
			fclose($myfile);
		}	
	}
	function readAFile(){
		$name=$_POST["input_file_name"];
		if(!file_exists("$name.txt")){  //Error Handling
			die("File not found!");
		}
		else{
			$myfile=fopen("$name.txt","r");
			echo fread($myfile,filesize("$name.txt"));
			fclose($myfile);
		}
	}
	function writeFile(){
		$name=$_POST["input_file_name"];
		if(!file_exists("$name.txt")){  //Error Handling
			die("File not found!");
		}
		else{
			$myfile=fopen("$name.txt","w");
			$txt=$_POST["data_input"];
			fwrite($myfile,$txt);
			fclose($myfile);
		}
	}
	function createFile(){
		$name=$_POST["input_file_name"];
		$myfile=fopen("$name.txt","w");
		fclose($myfile);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>File Handling Assignment</title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<label>Enter file name</label>
		<input type="text" name="input_file_name"><br>
		<label>Enter data to write</label>
		<input type="text" name="data_input"><br>
		<input type="submit" name="create_a_file" value="Create a file">
		<input type="submit" name="read_a_file" value="Read a file">
		<input type="submit" name="write_a_file" value="Write a file">
		<input type="submit" name="append_a_file" value="Append a file">
		<br><br><br>
		<input type="file" name="upload">
		<input type="submit" name="upload_read_button" value="Upload and Read">
		<input type="submit" name="upload_write_button" value="Upload and Write">
		<input type="submit" name="upload_append_button" value="Upload and Append">
	</form>
</body>
</html>
