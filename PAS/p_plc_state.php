<?php include("../login_check.php");?>
<html lang="zh-TW">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/txt.css">
		<link rel="stylesheet" href="../css/home.css">
		<title>高雄大學露營烤肉區租借系統</title>
	</head>
	<body>
		<?php include("header.php");?>
		
		<div class= "state">
			<?php
                echo "hello! ".$row[0];
            ?>
            <button onclick="logout();">[登出?]</button>
		</div>
        <div class = "content">
			<div class="title">
				<p>場地狀態查詢</p>
			</div>
			<div class="announce">
            <form method = "POST" action = "state.php">
                <h2>欲查詢日期</h2>
                <tr>
                    <td width=20% align="right"></td>
                    <td><input type="date" name="date" required></td>
                </tr>
				<tr>
            		<td colspan=2 ><input type="submit" value="送出" name="sub" size=20> </td>
        		</tr>
            </form>  
			</div>
        </div>
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