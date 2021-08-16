<?php include("../login_check.php");?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/txt.css">
		<link rel="stylesheet" href="../css/home.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script  src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
		<title>查看帳號資料</title>
	</head>

    <style>
        tr{
            text-align:left;
        }
    </style>

    <!--web content-->
    <body>

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

    <!--測試頁面轉pdf下載-->

        <!-- <script type="text/javascript">    
            function screenshot(){

                var doc = new jsPDF();
                html2canvas(document.getElementById('print')).then(function(canvas) {
                    document.body.appendChild(canvas);
                        var a= canvas.toDataURL("image/jpeg");
                        doc.addImage(a, 'JPEG', 0, 0, canvas.width/6, canvas.height/6);
                        doc.save('usr_info.pdf');
                        location.reload();
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
        </script>  -->
        
        <div class="content">
        <div class="title">使用者帳號資料</div>
        <div class="announce">
        <p >此為帳號基本資料。</p><br>
        <input type="button" value="修改資料" onclick="location.href='u_mod_acc.php'">
        <!-- <input type="button" value="下載" onclick="screenshot()"> -->
        <br>
        <center>

<?php
	include("../connect.php");//連接到資料庫
   
        //session_start();//啟用session
        if(isset($_SESSION['account'])){
            $getName=$_SESSION['account'];
        }

        //此處使用php7，注意sql語法
        $sql_query="select * from user where account='".$getName."'";
        $result=mysqli_query($link,$sql_query);
        $rows=mysqli_fetch_array($result);
        echo '<div id="print">';
        echo '<table border="1px">';
            echo '<tr>';
                echo '<td>使用者帳號：</td>';
                echo '<td>'.$rows[0].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>姓名：</td>';
                echo '<td>'.$rows[2].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>連絡電話：</td>';
                echo '<td>'.$rows[3].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>電子郵件：</td>';
                echo '<td>'.$rows[4].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>身分別：</td>';
                if(empty($rows[5])){
                    echo "<td>一般使用者</td>";
                }
                else if((int)$rows[5]===1){
                    echo "<td>系統管理員</td>";
                }
                else if((int)$rows[5]===2){
                    echo "<td>出納人員</td>";
                }
                else if((int)$rows[5]===3){
                    echo "<td>場地管理員</td>";
                }
            echo '</tr>';
            echo '<tr>';
                echo '<td>身分證字號：</td>';
                echo '<td>'.$rows[6].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>學號/教職員編號：</td>';
                echo '<td>'.$rows[7].'</td>';
            echo '</tr>';
        echo '</table>';
        echo '</div>';
    ?>
        <center>
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