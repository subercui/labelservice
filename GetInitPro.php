<?php
	
	$result=array();
	$path_prefix=$_REQUEST['path_prefix'];
	
	//获取已标记文件个数
	$Lab_dir=$path_prefix."/Labelled";
	$Lab_files=scandir($Lab_dir);
	$Lab_FileNums=count($Lab_files)-2;
	//获取待商量文件个数
	$ToL_dir=$path_prefix."/ToLabel";
	$ToL_files=scandir($ToL_dir);
	$ToL_FileNums=count($ToL_files)-2;
	
	//1、获取文件内容	
	$dir=$path_prefix."/UnLabelled";
	$files=scandir($dir);
	
	if(count($files)==2){
		$result[]=0;
		$result[]=$Lab_FileNums;
		$result[]=$ToL_FileNums;
	}else{
		$result[]=1;
		$result[]=count($files)-2;
		$result[]=$Lab_FileNums;
		$result[]=$ToL_FileNums;
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
		$result[]=$problem;
		$result[]=$anwser;
		$result[]=$nextfilename[count($nextfilename)-1];
	}

	echo json_encode($result);

?>