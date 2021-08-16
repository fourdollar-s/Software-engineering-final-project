<?php include("../login_check.php");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/txt.css">
		<link rel="stylesheet" href="../css/home.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script  src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
		<title>列印收據</title>
	</head>

    <style>
        tr{
            text-align:center;
        }
    </style>

    <!--web content-->
    <body>

    <!--頁面轉pdf下載-->
        <script type="text/javascript">    
            function screenshot(){
                var doc = new jsPDF();
                html2canvas(document.getElementById('print')).then(function(canvas) {
                    document.body.appendChild(canvas);
                        var a= canvas.toDataURL("image/jpeg");
                        doc.addImage(a, 'JPEG', 0, 0, canvas.width/3, canvas.height/3);
                        doc.save('receipt.pdf');
                        //location.reload();
                        //a.click();
                });

                // html2canvas(document.getElementById('print')).then(function(canvas) {
                //     document.body.appendChild(canvas);
                //         var a = document.createElement('a');
                //         a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
                //         a.download = 'usr_info.jpg';
                //         a.click();
                // });
            }
        </script> 

		<!-- 網頁最上方的標題 -->
		<header>
            <div class="nuk_cbrs"><a onclick=jumphome();>高雄大學露營烤肉區租借系統</a></div>
            <div class="subsystem"><br><a href="user.php">使用者首頁</a></div>
            <br>
            <!--選單-->
			<ul class="drop-down-menu">
                <li><a>帳號管理</a><!--有下拉請這樣寫-->
					<ul>
						<li><a href="u_view_acc.php">查看個人資料</a></li>
						<li><a href="u_mod_acc.php">修改個人資料</a></li>
						<li><a href="u_mod_passwd.php">修改密碼</a></li>
					</ul>
				</li>
				
				<li><a>場地租借</a><!--有下拉請這樣寫-->
					<ul>
						<li><a href="u_rent_app.php">場地租借</a></li>
						<li><a href="u_cancel_app.php">取消場地申請</a></li>
						<li><a href="u_mod_app.php">修改場地申請</a></li>
					</ul>
				</li>
 
				<li><a href="u_receipt_prt.php">列印收據</a></li>
                <li><a href="u_app_state.php">查看申請紀錄</a></li>
		    </ul>
            <br>
		</header>

        <div class= "state">
			<?php
                echo "hello! ".$row[0];
            ?>
            <button onclick="logout();">[登出?]</button>
		</div>

<div class="content">

            <div class="title">收據列印</div>
            <div class="announce">
            <p>狀態為已完成(過審核且已繳費)的申請才能產生並列印收據。</p>
            <center>

<?php
	include("../connect.php");//連接到資料庫
   
        //session_start();//啟用session
        if(isset($_SESSION['account'])){
            $getName=$_SESSION['account'];
        }

        //此處使用php7，注意sql語法
        $sql_query="SELECT `record_id` FROM `record` WHERE `account`='{$getName}' AND `state`=2";#取出此使用者已完成(審核通過且已繳費)的申請編號
        $result=mysqli_query($link,$sql_query);
?>

    <form action="u_receipt_prt_act.php" method="POST">
    <label for="receipt_id">請選擇要列印收據的申請編號：</label>
    <select name="receipt_id" id="receipt_id">
        <option value="">選擇編號</option>
<?php
        while($row=mysqli_fetch_row($result)){
            echo "<option value=".$row[0].">".$row[0]."</option>";
        }
?>
    </select>
    <input type="submit" value="receipt" id="receipt_btn" name="receipt_btn">
    </form>
</center>
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