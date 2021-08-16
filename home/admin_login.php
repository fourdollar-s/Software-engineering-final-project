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
		<div class="title">管理員登入<br></div>
			<div class="login">
				
				<br><br><br><br><br><br>
				<div class="input">
					<form method="post" action="">
						<center>
						<table border="0" width="70%" height="25%">
						
							<tr>
							<td align="center" width=250><font size="4">帳號</font></td>
							<td align="left"><input type=text name="account" style="width:200px;height:30px;font-size:18px"></td>
							</tr>
							<tr>
							<td align="center" width=300><font size="4">密碼</font></td>
							<td align="left"><input type=password name="password" style="width:200px;height:30px;font-size:18px"></td>
							</tr>
						</table>
						<p align="center">
						<input value="登入" name="sub" type="submit" style="font-size:18px;margin:40px;background-color: white;">
						</p>
					</form>
				</div>
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
<?php		
	if (isset($_POST["sub"])) 
	{
		include("../connect.php");
		$account = $_POST["account"];
		$password = $_POST["password"];

		if(($account != NULL) && ($password != NULL)){				
			
			$sql = "SELECT * FROM `user` WHERE `account`= '".$account."' AND  `password` = '".$password."' AND  `type` != 0";
			$result = $sql_qry->query($sql);
			$row = $result->fetch(PDO::FETCH_NUM);

			if (!$row) {
				echo "<script> alert('帳號或密碼錯誤');</script>";
			}
			else{
				session_start();
				$_SESSION['account'] = $account;
				$_SESSION['password'] = $password;
				echo "<script> alert('歡迎 ".$row[2]."') ;</script>";
				if($row[5] == 1){
					echo "<script> document.location.href='../SAS/SA.php';</script>";
				}
				else if($row[5]==2){
					echo "<script> document.location.href='../CAS/CA.php';</script>";
				}
				else if($row[5]==3){
					echo "<script> document.location.href='../PAS/PA.php';</script>";
				}

				
			}
			
		}
	}
?>