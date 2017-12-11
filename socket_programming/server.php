<?php
	
	$target_url='http://example.com/file_upload/client.php';
	$file_name=realpath('/home/webonise/hello.txt');
	$post=array('file_contents'=>'@'.$file_name);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$target_url);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
	curl_exec($ch);
	curl_close($ch);
?>