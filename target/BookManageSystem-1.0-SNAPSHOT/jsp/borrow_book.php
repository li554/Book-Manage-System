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
	$sql = "select maxborrow from user_base where id=".$_COOKIE['id'];
	$result = $conn->query($sql);
	$row = mysqli_fetch_row($result);
	$left = $row[0];
	if ($left==0){
		echo "您的可借数目已达上限";
	}else{
		$borrowdate = date("Y-m-d");
		$date = date_create($borrowdate);
		date_add($date,date_interval_create_from_date_string("30 days"));
		$intenddate = date_format($date,"Y-m-d");
		$sql = "insert into borrow_log(id,ISBN,borrowdate,returndate,intenddate,status) value(\""
		.$_COOKIE['id']."\",\""
		.$_POST['isbn']."\",\""
		.$borrowdate."\",null,\""
		.$intenddate."\",\"未还\")";
		echo $sql;
		$result = $conn->query($sql);
		$sql = "update user_base set maxborrow=maxborrow-1 where id=".$_COOKIE['id'];
		$result = $conn->query($sql);
		if ($result)
			echo "借书成功";
		else 
			echo "借书失败";
	}
 ?>