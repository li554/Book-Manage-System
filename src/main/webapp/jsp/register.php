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
	$sql = "insert into user_base(id,password,name,maxborrow) value(\"".$_POST['number']."\",\"".$_POST['password']."\",\"".$_POST['name']."\",3)";
	$result = $conn->query($sql);
	if ($result){
		echo 0;
	}else
		echo 1;
	$conn->close();
 ?>