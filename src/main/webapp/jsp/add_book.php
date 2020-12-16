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
$sql = "select * from book_base where ISBN=\"".$_POST['ISBN']."\"";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$flag = false;
if ($row){
	foreach($_POST as $key=>$value){
		if ($value!=""&&$key!="ISBN"){
			$sql = "update book_base set ".$key."=\"".$value."\" where ISBN=\"".$_POST['ISBN']."\"";
			$result = $conn->query($sql);
			$flag = true;
		}
	}
	if (!$flag){		//只有ISBN，其余均为空
		$sql = "delete from book_base where ISBN=\"".$_POST['ISBN']."\"";
		$result = $conn->query($sql);
		if ($result)
			echo "删除成功";
		else
			echo "删除失败";
	}else{
		if ($result)
			echo "更新成功";
		else
			echo "更新失败";
	}
	
}else{
	$sql = "select have,real_have from book_base where name=\"".$_POST['name']."\"";
	$result = $conn->query($sql);
	$row=mysqli_fetch_row($result);
	$have = 1;
	$real_have = 1;
	if ($row){	//查到了
		$have=$row[0]+1;
		$real_have=$row[1]+1;
	}
	$place = rand(100001,999999);
	if (!($_POST['ISBN']==""||$_POST['type']==""||$_POST['name']==""||$_POST['author']==""||$_POST['keywords']=="")){
		$sql = "insert into book_base(ISBN,type,name,author,press,intro,have,real_have,place,keywords,press_date)
		value(\"".$_POST['ISBN']."\",\"".$_POST['type']."\",\"".$_POST['name']."\",\"".$_POST['author']."\",\""
		.$_POST['press']."\",\"".$_POST['intro']."\",\"".$have."\",\"".$real_have."\",\"".$place."\",\"".$_POST['keywords']."\",\"".$_POST['press_date']."\")";
		$result = $conn->query($sql);
		if ($result)
			echo "录入成功";
		else 
			echo "录入失败";
	}else{
		echo "请填写完整或输入正确的ISBN号";
	}
}
 ?>
