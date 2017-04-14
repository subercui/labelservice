<?php
	
	//1、获取下一个文件内容
	$path_prefix=$_REQUEST['path_prefix'];
	$folder=$_REQUEST['folder'];
	
	
	$dir=$path_prefix."/".$folder;
	$files=scandir($dir);
	
	//获取文件内容
	$file=$dir."/".$files[count($files)-1];
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
	
	$flag=$_REQUEST['flag'];
	if($flag==1){//读数据库
		include "db_connect.php";
		$username=$_REQUEST['username'];
		$caseid=substr($result[2],0,-4);
		$sql="SELECT * from feature where CaseID='$caseid' and username='$username'";
		//echo $sql;
		$res=mysql_query($sql,$con);
		$row=mysql_fetch_array($res);
		$result[]=count($row);
		$result[]=$row;
		
	}
	
	echo json_encode($result);

?>