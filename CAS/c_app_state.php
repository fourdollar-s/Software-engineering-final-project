<?php include("../login_check.php")?>
<html>
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
		<div class="content">
			<div class="title">
				申請情況查詢
			</div>
			<div class = "announce">
<?php
	include("../connect.php");
			$name = NULL;
			
			?>
				<form method="GET" action="">
					<?php echo "<h3>帳號";?><input type=text size="20" name="usrName" value=''>
					<input value="查詢" type="submit">
				</form>
				
			<?php
			if(isset($_GET["usrName"])){
				$name = $_GET["usrName"];
			}
			# 設定時區
			date_default_timezone_set('Asia/Taipei');
			# 取得日期與時間（新時區）
			$time_now = date('Y/m/d');
			//echo $name;
			if($name==NULL){
				$sql_query="select * from record Limit 20";
				$result=mysqli_query($link,$sql_query);
				
			}
			else if($name != NULL){
				$sql_query="select * from record where account = '".$name."'";
				$result=mysqli_query($link,$sql_query);
				if(mysqli_num_rows($result) == 0){
					echo "<script> alert('帳號".$name."尚未有申請紀錄');</script>";
            		echo "<script> document.location.href='c_app_state.php';</script>";
				}
			}	
			
			echo '<center><table border = 1 width = 700px>';
				echo '<tr align="center">';
					echo '<td>訂單編號</td>';
					echo '<td>申請人帳號</td>';
					echo '<td>狀態</td>';
					echo '<td>繳費期限</td>';
					echo '<td>過審核日期</td>';
					echo '<td>金額</td>';
				echo '</tr>';

				while($row=mysqli_fetch_array($result)){
					echo '<tr align="center">';
					echo '<td>'.$row[0].'</td>';
					echo '<td>'.$row[9].'</td>';
					if($row[1] == "1"){//可繳費
						
						$deadline = date("Y-m-d",strtotime("+7 day",strtotime($row[5])));
						
						if((strtotime($deadline) - strtotime($time_now))/(60*60*24) < 0){
							echo '<td>繳費期限已過</td>';
							$change = "update record set state = 4 where record_id='".$row[0]."'";
							mysqli_query($link,$change);
						}
						else
							echo '<td><color=red>可繳費</td>';

						echo '<td>'.$deadline.'</td>';
						echo '<td>'.$row[5].'</td>';
					}
					else if($row[1] == 0){
						echo '<td>審核中</td>';
						echo '<td>-</td>';
						echo '<td>-</td>';
					}
					else if($row[1] == 2){
						echo '<td>已完成</td>';
						echo '<td>-</td>';
						echo '<td>'.$row[5].'</td>';
					}
					else if($row[1] == 3){
						echo '<td>審核失敗</td>';
						echo '<td>-</td>';
						echo '<td>-</td>';
					}
					else if($row[1] == 4){
						echo '<td>繳費期限已過</td>';
						$deadline = date("Y-m-d",strtotime("+7 day",strtotime($row[5])));
						echo '<td>'.$deadline.'</td>';
						echo '<td>'.$row[5].'</td>';
					}
					
					echo '<td>'.$row[2].'</td>';
				}
				echo '</tr>';
				echo '</table>';
				
		
    

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
