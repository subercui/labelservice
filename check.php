<?php	
	//登录  
	$username = htmlspecialchars($_REQUEST['username']);  
	$password = $_REQUEST['password'];  
	//包含数据库连接文件  
	include "db_connect.php";
	//检测用户名及密码是否正确  
	$check_query = mysql_query("select id from user where username='$username' and password='$password' limit 1",$con);  
	if($result = mysql_fetch_array($check_query)){  
		//登录成功  
		session_start();  
		$_SESSION['username'] = $username;  
		echo 1;
	} else {  
		echo 0;
	} 
?>