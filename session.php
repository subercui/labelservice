<?php
/*
 * Created on 2015-4-5
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
    session_start();
    if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
        	header("Location:login.php");
     }
?>
