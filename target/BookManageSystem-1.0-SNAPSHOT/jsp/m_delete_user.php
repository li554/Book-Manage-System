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

	$sql = "delete from user_base where id=\"".$_POST['id']."\"";
	echo $sql;
	$result = $conn->query($sql);
	if ($result)
		echo "删除成功";
	else
		echo "删除失败";
 ?>