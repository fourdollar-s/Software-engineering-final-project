<?php
	include("../login_check.php");
    include("../connect.php");
    $id = $_GET["id"];
    $sql = "SELECT `title`,`content` FROM `announcement` WHERE `id`=".$id." ";
	$result = $sql_qry->query($sql);
    $a = $result->fetch(PDO::FETCH_NUM);
    
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
		<?php include("header.php");?>
		
		
		<div class= "state">
			<?php
                echo "hello! ".$row[0];
            ?>
            <button onclick="logout();">[登出?]</button>
		</div>

		<div class= "content">
			<div class="title">
				<p><?php echo $a[0]; ?></p>
			</div>
			<div class="announce">
            <p><?php echo $a[1]; ?></p>

			</div>
			<a href="PA.php">回首頁</a>
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
