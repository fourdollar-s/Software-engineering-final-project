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

		<div class="content">
			<div class="title">
				<p>刪除規則</p>
			</div>
			<div class="announce">
			<?php
				include("../connect.php");
				$sql = "SELECT * FROM `available`";
				$result = $sql_qry->query($sql);
				echo "
					<table border=1 width='100%' align='center'>
					<tr align='center'>
						<td> 規則編號 </td>
						<td> 場地編號 </td>
						<td> 開始時間 </td>
						<td> 結束時間 </td>
					</tr>";
					while($row = $result->fetch(PDO::FETCH_ASSOC)) {
						echo "
							<tr align='center'>
								<td>".$row['id']."</td>
								<td>".$row['place_id']."</td>
								<td>".$row['time_start']."</td>
								<td>".$row['time_end']."</td>
							</tr>";
					}
					echo "</table>";
			?>
			<form method="POST" action="deleteAvailableDate.php">
				<tr>
					<td width=20% align="right">id:</td>
					<select name = "id">
					<li><a>id</a><!--有下拉請這樣寫-->
						<ul>
							<?php
								include("Connect.php");
								$sql = "SELECT * FROM `available`";
								$result = $sql_qry->query($sql);
								while($row1 = $result->fetch(PDO::FETCH_ASSOC)) {
									echo "<option>".$row1['id']."</option>";
								}
							?>				
						</ul>
					</li>
					</select>
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