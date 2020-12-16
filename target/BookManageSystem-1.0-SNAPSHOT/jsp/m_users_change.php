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
	$arr = json_decode($_POST['data']);
	for ($i=0;$i<count($arr);$i++){
		if (count($arr[$i])==5){  //证明是插入的
    		$sql = "insert into user_base(id,password,name,maxborrow) value(\""
    		.$arr[$i][0]."\",\""
    		.$arr[$i][1]."\",\""
    		.$arr[$i][2]."\","
    		.$arr[$i][3].")";
    		$result = $conn->query($sql);
    		echo $sql;
    		echo json_encode($result);
		}else{
			$sql = "update user_base set password=\""
			.$arr[$i][1]."\",name=\""
			.$arr[$i][2]."\",maxborrow="
			.$arr[$i][3]." where id=\"".$arr[$i][0]."\"";
			$result = $conn->query($sql);
			echo $sql;
			echo json_encode($result);
		}
	}
 ?>				