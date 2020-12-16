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
	$sql = "update user_base set password=\"".$_POST['new_ps']."\" where id=\"".$_POST['id']."\"";
	$result = $conn->query($sql);
	echo json_encode($_POST);
	echo json_encode($result);
	echo $sql;
	if ($result)
		echo "修改成功";
	else
		echo "修改失败";
 ?>