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
				列印收據
			</div>
			<div class = "announce">
		
<?php
	include("../connect.php");
    	//echo '修改基本資料頁面<br>';
   	 
			//session_start();
			echo '最近繳費之單號:'.$_SESSION["recently_pay_id"];
			$id = "";
			?>
				<form method="post" action="">
					<?php echo "<h2>申請單號";?><input type=text size="20" name="id" value=''>
					<input value="查詢" type="submit">
				</form>

			<?php
			if(isset($_POST["id"])){
				$id = $_POST["id"];
			}
			# 設定時區
			date_default_timezone_set('Asia/Taipei');
			# 取得日期與時間（新時區）
			$time_now = date('Y/m/d');
			//echo $name;
			if($id==NULL){
				$sql_query="select * from record Limit 20";
				$result=mysqli_query($link,$sql_query);
			}
			else if($id != NULL){
				$sql_query="select * from record where record_id = '".$id."' and state = '2'";
				$result=mysqli_query($link,$sql_query);
				if(mysqli_num_rows($result) == 0){
					echo "<script> alert('單號".$id."尚未完成，無法列印');</script>";
            		echo "<script> document.location.href='c_pay_prt.php';</script>";
					$sql_query="select * from record where record_id = '".$id."'";
					$result=mysqli_query($link,$sql_query);
				}
				else
					echo "<br>目前查詢的單號為:".$id;
			}
				echo "<center>";
					echo '<table border=1>';
					echo '<tr align="center">';
					echo '<td>訂單編號';
					echo '<td width = 200px></tr>';

				while($row=mysqli_fetch_array($result)){
					if($row[1] == "2"){//已完成

						

						echo '<tr>';
						echo '<td align="center"><font size="3">'.$row[0];

						?>
						
						<td align="center">
							<form method="post" action="c_receipt_prt.php" target="_blank">
								<input type="hidden" name="money" value="<?php echo $row[2];?>">
								<input type="hidden" name="id" value="<?php echo $row[0];?>">	
								<input type="hidden" name="name" value="<?php echo $row[9];?>">	
								<input value="列印" type="submit">
							</form>
						</td>
						<?php
					}
					else{
						echo '<tr>';
						echo '<td align="center"><font size="3">'.$row[0];
						$state = NULL;
						if($row[1] == 0)
							$state = "審核中";
						else if($row[1] == 1)
							$state = "繳費中";
						else if($row[1] == 3)
							$state = "審核失敗";
						else if($row[1] == 4)
							$state = "繳費期限已過";
						echo '<td align="center"><font size="3">'.$state;
					}
				}
				
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
