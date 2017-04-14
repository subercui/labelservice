<?php
/*
 * Created on 2015-4-4
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 		$con= mysql_connect("localhost","root","") or die("不能连接到数据库服务器，可能是数据库服务器没有启动，或者用户名密码错误".mysql_error());
       	$link=mysql_select_db("label",$con);
       	mysql_query("set names utf8");
       	if(!$link){
       		echo "database linking error";
       	}
?>