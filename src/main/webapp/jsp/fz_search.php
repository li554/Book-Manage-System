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
	$sql = "SELECT * from book_base WHERE name like \"%%".$_POST['q']."%%\"\n"
    . "UNION\n"
    . "SELECT * from book_base WHERE author like \"%%".$_POST['q']."%%\"\n"
    . "UNION\n"
    . "SELECT * from book_base WHERE type like \"%%".$_POST['q']."%%\"";
    $result = $conn->query($sql);
    echo "[";
    while ($row = mysqli_fetch_row($result)){
    	echo json_encode($row,JSON_UNESCAPED_UNICODE).",";
    }
    echo "[]]";
 ?>