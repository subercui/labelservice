<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
/*
 * Created on 2015-5-3
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
        //error_reporting(0);
		include "db_connect.php";
		$username =$_REQUEST['username'];
		$password=$_REQUEST['password'];
       	$sql=mysql_query("select * from user where username='$username'");
       	$result=mysql_fetch_array($sql);
       	if($result['password']==$password){
       			session_start();
       			$_SESSION['username']=$username;
				$_SESSION['password']=$password;
       			header("location:index.php");//跳转到首页面
       	}else{
       			echo "<script>alert('您输入的用户名或密码错误');window.location.href='login.php'</script>";
       	}
?>