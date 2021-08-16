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
		<div class='content'>
			<div class="title">
				<p>租借申請審核</p>
			</div>
			<div class="announce">
			<?php
				include("../connect.php");
				$sql = "SELECT * FROM `record` WHERE `state` = 0 OR `state` = 1 OR `state` = 3";
				$result = $sql_qry->query($sql);
				echo "
					
					<table border=1 width='100%' align='center'>
					<tr align='center'>
						<td> 申請編號 </td>
						<td> 申請時間 </td>
						<td> 狀態 </td>
					</tr>";
				while($row = $result->fetch(PDO::FETCH_ASSOC)) {
					echo "
						<tr align='center'>
							<td>".$row['record_id']."</td>
							<td>".$row['apply_date']."</td>";
							$state;
                                switch($row['state']){
                                    case '0': $state = "審核中"; break;
                                    case '1': $state = "繳費中"; break;
                                    case '2': $state = "完成"; break;
                                    case '3': $state = "審核失敗"; break;
                                    case '4': $state = "逾期未繳"; break;
                                    case '5': $state = "取消申請"; break;
                                    default: $state = "Unknown";
                                }
						echo "<td>".$state."</td>
						</tr>";
				}
				echo "</table>";
			?>
			<form method="POST" action="Application.php">
				<tr>
					<td width=20% align="right">id:</td>
					<select name = "id">
					<li>
						<ul>
							<?php
								include("../connect.php");
								$sql = "SELECT * FROM `record` WHERE `state` = 0 OR `state` = 1 OR `state` = 3";
								$result = $sql_qry->query($sql);
								while($row1 = $result->fetch(PDO::FETCH_ASSOC)) {
									echo "<option>".$row1['record_id']."</option>";
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