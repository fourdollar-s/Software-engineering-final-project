<?php
	include("../connect.php");
	session_start();	
?>
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
			<div class="title">
				<p>建立您的帳號</p>
			</div>

			<div class="register">
				
				<div class="reg_left">
					<form method="POST" action="">
					<div class="reg_body">
					<h3>身分</h3>
					<hr>
					<br>
					<br>
					<input type="radio" name="type" value="school" 
					<?php 
					if(isset($_SESSION['Type'])){echo' disabled';if($_SESSION['Type']=="school"){echo' checked';}}
					
					?>
					><h4>校內人員</h4>
					<br>
					<input type="radio" name="type" value="outside" 
					<?php 
					if(isset($_SESSION['Type'])){echo' disabled';if($_SESSION['Type']=="outside"){echo' checked';}}
					
					?>
					><h4>校外人士</h4>
					</div>
					<div class="reg_foot">
					<input type="submit" value="重設" name="back1" style="width:45%;height:30px;"> </input>
					<input type="submit" value="下一步" name="sub1"style="width:45%;height:30px;"
					<?php 
					if(isset($_SESSION['Type'])){echo ' disabled';}
					?>
					></input>
					</div>
					
					</form>
				</div>
				<?php
					if(isset($_POST["back1"])){
						session_destroy();
						header("location: register.php");
					}
					if(isset($_POST["back2"])){
						unset($_SESSION["name"]);
						unset($_SESSION["tel"]);
						unset($_SESSION["mail"]);
						if(isset($_SESSION["school_id"])){
							unset($_SESSION["school_id"]);
						}
						if(isset($_SESSION["number"])){
							unset($_SESSION["number"]);
						}
						header("location: register.php");
					}
					if(isset($_POST["sub1"]) ){
						
						$_SESSION['Type'] = $_POST["type"];
						header("location: register.php");
					}
					if(isset($_SESSION['Type'])){
						echo'
								<div class="reg_mid">
									<form method="post" action="">
									<div class="reg_body">
									<h3>基本資料</h3>
										<hr>
										<br>

										<h4>名字</h4>
										<input type="text" name="name" size=10 placeholder="名字" required';
										if(isset($_SESSION['name'])){echo' disabled' ;echo ' value='.$_SESSION["name"];} echo'>';
										echo'
										<h4>電話</h4>
										<input type="tel" name="tel" size=15 placeholder="電話" required ';
										if(isset($_SESSION['tel'])){echo' disabled' ;echo ' value='.$_SESSION["tel"];} echo'>';
										echo'
										<h4>Email</h4>
										<input type="email" name="mail" size=15 placeholder="mail" required';
										if(isset($_SESSION['mail'])){echo' disabled' ;echo ' value='.$_SESSION["mail"];} echo'>';
										if($_SESSION['Type'] == "school"){
											echo'
											<h4>學號</h4>
											<input type="text" name="school_id" size=15 placeholder="學號or員工編號" required ';
											if(isset($_SESSION['school_id'])){echo' disabled' ;echo ' value='.$_SESSION["school_id"];} echo'>';
										}
										elseif($_SESSION['Type'] == "outside"){
											echo'
											<h4>身分證字號</h4>
											<input type="text" name="number" size=15 placeholder="員工編號" required ';
											if(isset($_SESSION['number'])){echo' disabled' ;echo ' value='.$_SESSION["number"];} echo'>';
										}
										echo '</div>';
										echo'<div class="reg_foot">
										<input type="submit" value="重設" name="back2" style="width:45%;height:30px;"> </input>
										<input type="submit" value="下一步" name="sub2" style="width:45%;height:30px"; ';
										if(isset($_SESSION['Type']) && isset($_SESSION["name"]) && isset($_SESSION["tel"]) &&
										isset($_SESSION["mail"]) && ( isset($_SESSION["school_id"]) || isset($_SESSION["number"]) )
										){echo ' disabled';}
										echo'
										></input>
										</div>
									</form>
								</div>
							';
						
						
					}
					if(isset($_POST["sub2"])){
						if($_SESSION['Type']=="school"){
							$_SESSION["name"] = $_POST["name"];
							$_SESSION["tel"] = $_POST["tel"];
							$_SESSION["mail"] = $_POST["mail"];
							$_SESSION["school_id"] = $_POST["school_id"];
						}
						elseif($_SESSION['Type']=="outside"){
							$_SESSION["name"] = $_POST["name"];
							$_SESSION["tel"] = $_POST["tel"];
							$_SESSION["mail"] = $_POST["mail"];
							$_SESSION["number"] = $_POST["number"];
						}
						header("location: register.php");
					}
					if(isset($_POST["sub3"])){	
						//檢查密碼相同
						if ($_POST["password"] != $_POST["check_password"]) {
							echo "<script> alert('密碼確認失敗(不相同)');history.back();</script>";				
							exit();
						}	
						//檢查帳號數>=5
						elseif(strlen($_POST["account"])<5){
							echo "<script> alert('帳號至少需5個字元');history.back();</script>";
							exit();
						}
						//檢查密碼數>=5
						elseif(strlen($_POST["password"])<5){
							echo "<script> alert('密碼至少需5個字元');history.back();</script>";
							exit();
						}
						//檢查帳號是否已使用		
						$sql = "SELECT * FROM `user` WHERE `account`='".$_POST["account"]."'";
						$result = $sql_qry->query($sql);
						$row = $result->fetch(PDO::FETCH_ASSOC);
						if ($row) {
							echo "<script> alert('帳號已有人使用');history.back();</script>";
							exit();
						}
						//建立帳號
						if(isset($_SESSION['school_id'])){
							$sql = "INSERT INTO `user`(`account`,`password`,`name`,`tel`,`mail`,`type`,`school_id`,`number`)
							VALUES('" . $_POST["account"] . "','" . $_POST["password"] . "','" . $_SESSION['name'] . "','" . $_SESSION['tel'] . "','" . $_SESSION['mail'] . "',0,'" . $_SESSION['school_id'] . "',NULL)";
							if ($sql_qry->exec($sql)) {
								echo "<script> alert('註冊成功');</script>";
								echo "<script> document.location.href='home.php';</script>";
							} 
							else {
								echo "<script> alert('註冊失敗');history.back();</script>";
								exit();
							}
						}
						elseif(isset($_SESSION['number'])){
							$sql = "INSERT INTO `user`(`account`,`password`,`name`,`tel`,`mail`,`type`,`school_id`,`number`)
							VALUES('" . $_POST["account"] . "','" . $_POST["password"] . "','" . $_SESSION['name'] . "','" . $_SESSION['tel'] . "','" . $_SESSION['mail'] . "', 0 , NULL ,'" . $_SESSION['number'] . "')";
							if ($sql_qry->exec($sql)) {
								echo "<script> alert('註冊成功');</script>";
								echo "<script> document.location.href='home.php';</script>";
							} else {
								echo "<script> alert('註冊失敗');history.back();</script>";
								exit();
							}
						}
					}
					if(isset($_SESSION['Type']) && isset($_SESSION["name"]) && isset($_SESSION["tel"]) &&
						isset($_SESSION["mail"]) && ( isset($_SESSION["school_id"]) || isset($_SESSION["number"]) )){
						echo'
							<div class="reg_right">
								<form method="post" action="">
								<div class="reg_body">
								<h3>帳號密碼</h3>
								<hr>
								<br>
								<h4>帳號</h4>					
								<input type="text" size=15 name="account"  placeholder="帳號" required>
								<br>
								<h4>密碼</h4>
								<input type="password" size=15 name="password"  placeholder="密碼" required>
								<h4>確認密碼</h4>
								<input type="password" size=15 name="check_password"  placeholder="確認密碼" required>
								</div>
								<div class="reg_foot">
								<input type="reset" value="重設" style="width:45%;height:30px;"> </input>
								<input type="submit" value="註冊" name="sub3" style="width:45%;height:30px;"></input>
								</div>
								</form>
							</div>	
						';
					}
				?>
			
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