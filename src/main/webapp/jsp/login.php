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
	$sql = "";
	if ($_POST['number']=="00000000000"){
		$sql = "select * from manager_base where id=".$_POST['number'];
	}else{
		$sql = "select * from user_base where id=".$_POST['number'];
	}
	$result = $conn->query($sql);
	if ($result){
		$row = mysqli_fetch_row($result);
		if ($row)
			echo json_encode($row);
		else
			echo "null";
	}else{
		echo "null";
	}	
	$conn->close();
?>