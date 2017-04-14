<?php
	
	//1、获取下一个文件内容
	$path_prefix=$_REQUEST['path_prefix'];
	$folder=$_REQUEST['folder'];
	
	$dir=$path_prefix."/".$folder;
	$files=scandir($dir);
	
	//获取文件内容
	$file=$dir."/".$files[2];
	$fileToGbk = mb_convert_encoding($file, 'utf-8', 'gbk');
	$nextfilename=explode("/",$fileToGbk);
	
	//获得字符串之后马上把字符串转成另一种编码
	$content = file_get_contents($file);
	$content = mb_convert_encoding($content, 'utf-8', 'gbk');
	$str  = explode("\r\n", $content); 
	$problem=substr($str[0],9);
	$anwser=substr($str[1],15);
	$result=array();
	$result[]=$problem;
	$result[]=$anwser;
	$result[]=$nextfilename[count($nextfilename)-1];
	
	
	echo json_encode($result);

?>