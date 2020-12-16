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
	$returndate = date("Y-m-d");
	$sql = "update borrow_log set returndate=\"".$returndate."\" where id=\"".$_COOKIE['id']
	."\" and ISBN=\"".$_POST['isbn']."\"";
	$result = $conn->query($sql);
	$sql = "update borrow_log set status=\"已还\" where id=\"".$_COOKIE['id']
	."\" and ISBN=\"".$_POST['isbn']."\"";
	$result = $conn->query($sql);
	$sql = "update user_base set maxborrow=maxborrow+1 where id=".$_COOKIE['id'];
	$result = $conn->query($sql);
	if ($result)
		echo "还书成功";
	else 
		echo "还书失败";
 ?>