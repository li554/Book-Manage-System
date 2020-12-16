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
	$sql = "select * from book_base where keywords like \"%%".$_POST['q']."%%\"";
    $result = $conn->query($sql);
    echo "[";
    while ($row = mysqli_fetch_row($result)){
    	echo json_encode($row,JSON_UNESCAPED_UNICODE).",";
    }
    echo "[]]";
 ?>