<?php
	
	$path_prefix=$_REQUEST['path_prefix'];
	//1、获取下一个文件内容
	$dir=$path_prefix."/UnLabelled";
	$files=scandir($dir);
	
	//获取文件内容
	$file=$dir."/".$files[3];
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
	
	//2、将当前UnLabelled文件移动到ToLabel中

	$filename=$_REQUEST['filename'];


	$filename = mb_convert_encoding($filename, 'gbk', 'utf-8');
	$file=$path_prefix."/UnLabelled/".$filename;
	$moveTo=$path_prefix."/ToLabel/".$filename;

	copy($file,$moveTo); //拷贝到新目录
	unlink($file); //删除旧目录下的文件

?>