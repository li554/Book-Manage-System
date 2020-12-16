<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>图书管理-查询</title>
<link href="../css/publice.css" type="text/css" rel="stylesheet" />
<link href="../css/style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/manager.css">
<script type="text/javascript" src="../js/jquery1.42.min.js" ></script>
<script type="text/javascript" src="../js/jquery.SuperSlide.2.1.1.js" ></script>
<script type="text/javascript" src="../js/style.js" ></script>
<script type="text/javascript" src="../js/search.js"></script>
</head>
<body>
	
<!--top_bar-->
<div class="clear"></div>
<div class="topWrap">
	<div class="top_bar">
		<div class="top_left">
			欢迎访问-查询结果！
		</div>
		<div class="top_right">
		    <a class="land" href="login.html"> 登录 </a>
			<select class="connection">
                   <option value="volvo">联系我们</option>
                   <option value="saab">QQ:3061815893</option>
                   <option value="opel">微信：GXG20000915</option>
            </select>
		</div>
	</div>
</div>

<!--nav-->
<div class="clear"></div>
<div class="navWrap">
	<div class="logo"><a href="../index.html"><img src="../img/logo.png"></a></div>
	<div class="nav_bar">
		<a href="../index.html">首页</a>
		<a href="javascript:;" class="cur">查询结果</a>
	</div>
</div>
<!--banner-->
<div id="nav-b">
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
		echo "<div class=\"borrow_left\">剩余可借数量:".$row[0]."</div>"; 
		$sql = "select borrow_log.*,book_base.name as bookname,case when timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate)>0 then timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) else -timestampdiff(day,CURRENT_DATE(),borrow_log.intenddate) end overdate from borrow_log,book_base where id=\"".$_COOKIE['id']."\" and book_base.ISBN=borrow_log.ISBN";
		$result = $conn->query($sql);
		echo "<table class=\"mytable\">";
		echo "<tr>";
		echo "<td>书籍名称</td>";
		echo "<td>借出时间</td>";
		echo "<td>归还时间</td>";
		echo "<td>应还时间</td>";
		echo "<td>是否归还</td>";
		echo "<td>过期或剩余天数</td></tr>";
		while ($row = mysqli_fetch_row($result)){
			echo "<tr>";
			echo "<td>".$row[6]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[7]."</td>";
			echo "</tr>";
		}
		echo "</table>";
		
     ?>
</div>

<script src='js/jquery.min.js'></script>
<script src="js/script.js"></script>
<!--main-->

<!--foot-->
<div class="clear"></div>
<div class="footWrap">
	<div class="footer">
		<div class="foot_l">
			<p><img src="../img/foot_icon1.png">151-5601-9782</p>
			<a href="https://www.amap.com/place/B0FFG8Y6Y5"target="_self"><img src="../img/foot_icon2.png">点击了解我们的位置</a>
		</div>
		<div class="foot_r">
			
		</div>
		
          
	</div>
</div>
<div class="wz" style=" text-align:center;">©戈小戈</div>
</body>
</html>
