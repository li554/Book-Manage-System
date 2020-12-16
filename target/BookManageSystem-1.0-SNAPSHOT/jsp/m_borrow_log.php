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
	$type = $_POST['type'];
	if ($_POST['type']=="全部")
		$type = "%";
	if ($_POST['mode']=="图书属性"){
		global $type;
		$sql = "select * from book_base where ISBN like \"%".$_POST['ISBN']."%\"  and type like \"".$type."\"".
		" union \n ".
		"select * from book_base where name like \"%%".$_POST['ISBN']."%%\" and type like \"".$type."\"";
		$result = $conn->query($sql);
		echo "<table class=\"mytable\">";
		echo "<tr>";
		echo "<td>ISBN</td>";
		echo "<td>类型</td>";
		echo "<td>书籍名称</td>";
		echo "<td>作者</td>";
		echo "<td>出版社</td>";
		echo "<td>出版日期</td>";
		echo "<td>简介</td>";
		echo "<td>馆藏</td>";
		echo "<td>可借</td>";
		echo "<td>存放位置</td>";
		echo "<td>关键词</td></tr>";
		while ($row=mysqli_fetch_row($result)){
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[10]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			echo "<td>".$row[7]."</td>";
			echo "<td>".$row[8]."</td>";
			echo "<td>".$row[9]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}else if ($_POST['mode']=="借阅记录"){
		$sql = "select user_base.id as id,user_base.name as username,borrow_log.*,book_base.name as bookname,case when timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate)>0 then timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) else -timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) end overdate from borrow_log,book_base,user_base where borrow_log.id like \"%".$_POST['id']."%\" and book_base.ISBN=borrow_log.ISBN and user_base.id=borrow_log.id and borrow_log.ISBN like \"%".$_POST['ISBN']."%\"".
			" and book_base.type like \"".$type."\"".
		" union\n".
		"select user_base.id as id,user_base.name as username,borrow_log.*,book_base.name as bookname,case when timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate)>0 then timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) else -timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) end overdate from borrow_log,book_base,user_base where user_base.name like \"%%".$_POST['id']."%%\" and book_base.ISBN=borrow_log.ISBN and user_base.id=borrow_log.id and book_base.name like \"%%".$_POST['ISBN']."%%\"".
			" and book_base.type like \"".$type."\"".
		" union\n ".
		"select user_base.id as id,user_base.name as username,borrow_log.*,book_base.name as bookname,case when timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate)>0 then timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) else -timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) end overdate from borrow_log,book_base,user_base where borrow_log.id like \"%%".$_POST['id']."%%\" and book_base.ISBN=borrow_log.ISBN and user_base.id=borrow_log.id and book_base.name like \"%%".$_POST['ISBN']."%%\"".
			" and book_base.type like \"".$type."\"".
		" union\n ".
		"select user_base.id as id,user_base.name as username,borrow_log.*,book_base.name as bookname,case when timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate)>0 then timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) else -timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) end overdate from borrow_log,book_base,user_base where user_base.name like \"%%".$_POST['id']."%%\" and book_base.ISBN=borrow_log.ISBN and user_base.id=borrow_log.id and borrow_log.ISBN like \"%%".$_POST['ISBN']."%%\"".
			" and book_base.type like \"".$type."\"";
		$result = $conn->query($sql);
		echo "<table class=\"mytable\">";
		echo "<tr>";
		echo "<td>用户ID</td>";
		echo "<td>用户名称</td>";
		echo "<td>书籍名称</td>";
		echo "<td>借出时间</td>";
		echo "<td>归还时间</td>";
		echo "<td>应还时间</td>";
		echo "<td>是否归还</td>";
		echo "<td>过期或剩余天数</td></tr>";
		while ($row = mysqli_fetch_row($result)){
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[8]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			echo "<td>".$row[7]."</td>";
			echo "<td>".$row[9]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
 ?>	