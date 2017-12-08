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
	<form method="POST">
		<label>Enter file name</label>
		<input type="text" name="input_file_name"><br>
		<label>Enter data to write</label>
		<input type="text" name="data_input"><br>
		<input type="submit" name="create_a_file" value="Create a file">
		<input type="submit" name="read_a_file" value="Read a file">
		<input type="submit" name="write_a_file" value="Write a file">
		<input type="submit" name="append_a_file" value="Append a file">
	</form>
</body>
</html>
