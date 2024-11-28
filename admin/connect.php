<?php
    $dsn = 'mysql:host=localhost;dbname=restaurant_website';
	$user = 'root';
	$pass = '123456';
	$option = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	);
	try
	{
		$con = new PDO($dsn,$user,$pass,$option);
		$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		//echo 'Good Very Good !';
	}
	catch(PDOException $ex)
	{
		echo "Không thể kết nối với cơ sở dữ liệu ! ".$ex->getMessage();
		die();
	}
?>