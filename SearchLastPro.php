<?php
	
	//1、获取下一个文件内容
	$path_prefix=$_REQUEST['path_prefix'];
	$username=$_REQUEST['username'];
	$folder=$_REQUEST['folder'];
	$curPage=$_REQUEST['curPage'];
	
	$dir=$path_prefix."/".$folder;
	$files=scandir($dir);
	
	//获取文件内容
	$file=$dir."/".$files[$curPage];
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

	include "db_connect.php";
	$caseid=substr($result[2],0,-4);
	$sql="select * from feature where CaseID='$caseid' and username='$username'";
	$res=mysql_query($sql,$con);
    $row=mysql_fetch_array($res);
	$result[]=count($row);
	$result[]=$row;
	echo json_encode($result);

?>