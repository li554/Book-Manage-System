<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mydb";
	// 创建连接
	$conn = new mysqli($servername, $username, $password,$dbname);
	 
	// 检测连接
	if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
	} 
	$sql = "update user_base set name=\"".$_POST['name']."\" where id=".$_COOKIE['id']; 
	$result = $conn->query($sql);
	if ($result)
		echo "更新成功";
	else
		echo "更新失败";
 ?>