<?php
/*
 * Created on 2015-5-3
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
        //error_reporting(0);
		$path_prefix=$_REQUEST['path_prefix'];
		$searchFile=$_REQUEST['searchFile'];
		$file1=$path_prefix."/UnLabelled/".$searchFile.".txt";
		$file1=iconv('UTF-8','GB2312',$file1);
		
		$file2=$path_prefix."/Labelled/".$searchFile.".txt";
		$file2=iconv('UTF-8','GB2312',$file2);
		
		$file3=$path_prefix."/ToLabel/".$searchFile.".txt";
		$file3=iconv('UTF-8','GB2312',$file3);
	
		$result=array();
		if(file_exists($file1)){//存在于未标记里
			$result[]=1;
			//获得字符串之后马上把字符串转成另一种编码
			$content = file_get_contents($file1);
			$content = mb_convert_encoding($content, 'utf-8', 'gbk');
			$str  = explode("\r\n", $content); 
			$problem=substr($str[0],9);
			$anwser=substr($str[1],15);
			$result[]=$problem;
			$result[]=$anwser;
			
		}else if(file_exists($file2)){//存在于已标记里
			$result[]=2;
			//获得字符串之后马上把字符串转成另一种编码
			$content = file_get_contents($file2);
			$content = mb_convert_encoding($content, 'utf-8', 'gbk');
			$str  = explode("\r\n", $content); 
			$problem=substr($str[0],9);
			$anwser=substr($str[1],15);
			$result[]=$problem;
			$result[]=$anwser;
			
			//从数据库中读取数据
			include "db_connect.php";
			$sql="select * from feature where CaseID='$searchFile'";
			$res=mysql_query($sql,$con);
			$row=mysql_fetch_array($res);
			$result[]=count($row);
			$result[]=$row;
			
		}else if(file_exists($file3)){//存在于待商量里
			$result[]=3;
			//获得字符串之后马上把字符串转成另一种编码
			$content = file_get_contents($file3);
			$content = mb_convert_encoding($content, 'utf-8', 'gbk');
			$str  = explode("\r\n", $content); 
			$problem=substr($str[0],9);
			$anwser=substr($str[1],15);
			$result[]=$problem;
			$result[]=$anwser;
		}else{
			$result[]=4;
		}
		echo json_encode($result);
?>