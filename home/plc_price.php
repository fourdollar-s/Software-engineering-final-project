<html lang="zh-TW">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/txt.css">
		<link rel="stylesheet" href="../css/home.css">
		<title>高雄大學露營烤肉區租借系統</title>
	</head>
	<body>
		<!--網頁最上方的標題 -->
		<header>
			<div class="nuk_cbrs">
				<a href="home.php">高雄大學露營烤肉區租借系統</a>
			</div>
			<br>
			<div class="subsystem">
				<a href="home.php">系統首頁</a>
			</div>
			<br>
			<!--選單-->
			<ul class="drop-down-menu">
				<li><a href="plc_state.php">場地狀態查詢</a></li>
				<li><a href="plc_price.php">場地價位查詢</a></li>				
				<li><a>登入</a><!--有下拉請這樣寫-->
					<ul>
						<li><a href="user_login.php">使用者登入</a></li>
						<li><a href="admin_login.php">管理員登入</a></li>
						<li><a href="passwd_forgot.php">忘記密碼</a></li>
					</ul>
				</li>
				<li><a href="register.php">申請帳號</a></li>	
			</ul>

		</header>
		<div class="content">
			<div class="title">場地價位查詢</div>
			<div class="announce">
			<center>
			<table border="1" width=50% style="text-align: center;">
				<tr>
				<td>場地種類</td>
				<td>校內價格</td>
				<td>校外價格</td>
				</tr>
<?php
					include("../connect.php");
					
					//找出資料庫中有幾筆符合的
					$query="SELECT * FROM place WHERE type='1'";//種類要再改
					$result=mysqli_query($link,$query);
					$row=mysqli_fetch_array($result);	
						
					
?>
				<tr>
				<td>露營位</td>
				<td><?php echo $row[2]?></td>
				<td><?php echo $row[3]?></td>
				</tr>
<?php
					$query="SELECT * FROM place WHERE type='0'";
					$result=mysqli_query($link,$query);
					$row=mysqli_fetch_array($result);	
?>
				<tr>
				<td>烤肉台</td>
				<td><?php echo $row[2]?></td>
				<td><?php echo $row[3]?></td>
				</tr>
				
			</table>
			</center>
			
			
			
			
			
			</div>
		</div>
		<!-- 網頁下方的工具列或訊息 -->
		<footer>
			<h1>
				© 2015 高雄大學 National University of Kaohsiung<br>
				81148 高雄市楠梓區高雄大學路700號<br>
				700, Kaohsiung University Rd., Nanzih District, Kaohsiung 811, Taiwan, R.O.C.<br>
				高大總機:886-7-5919000 傳真號碼:886-7-5919083<br>
				高大校園緊急聯絡電話:886-7-5917885 高大警衛室:886-7-5919009<br>
			</h1>
		</footer>
	</body>
</html>