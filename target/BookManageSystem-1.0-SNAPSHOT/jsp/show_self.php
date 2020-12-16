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
	$sql = "select * from user_base where id=".$_COOKIE['id']; 
	$result = $conn->query($sql);
	$row = mysqli_fetch_row($result);
	echo json_encode($row);
 ?>