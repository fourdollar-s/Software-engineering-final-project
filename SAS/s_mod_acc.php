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
		<!--網頁最上方的標題 -->
		<header>
			<div class="nuk_cbrs">
				<a onclick=jumphome();>高雄大學露營烤肉區租借系統</a>
			</div>
			<div class="subsystem">
			<br>
			<a href="SA.php">系統管理員首頁</a>
			</div>
			<br>
			<!--選單-->
			<ul class="drop-down-menu">
                <li><a>帳號管理</a><!--有下拉請這樣寫-->
					<ul>
						<li><a href="s_view_acc.php">查看帳號</a></li>
						<li><a href="s_add_acc.php">新增帳號</a></li>
						<li><a href="s_mod_acc.php">修改帳號</a></li>
                        <li><a href="s_del_acc.php">刪除帳號</a></li>
					</ul>
				</li>
				
				<li><a>場地管理</a><!--有下拉請這樣寫-->
					<ul>
						<li><a href="s_view_plc.php">查看場地資訊</a></li>
						<li><a href="s_add_plc.php">新增場地資訊</a></li>
						<li><a href="s_mod_plc.php">修改場地資訊</a></li>
                        <li><a href="s_del_plc.php">刪除場地資訊</a></li>
					</ul>
				</li>
                <li><a>公告管理</a><!--有下拉請這樣寫-->
					<ul>
						<li><a href="s_view_announce.php">查看公告</a></li>
						<li><a href="s_add_announce.php">新增公告</a></li>
						<li><a href="s_mod_announce.php">修改公告</a></li>
                        <li><a href="s_del_announce.php">刪除公告</a></li>
					</ul>
				</li>
                <li><a>紀錄管理</a><!--有下拉請這樣寫-->
					<ul>
                        <li><a href="s_rec_archive.php">紀錄歸檔</a></li>
						<li><a href="s_app_state.php">申請紀錄查詢</a></li>						
					</ul>
				</li>
				
				
					
			</ul>
		<br>
		</header>
		
		<div class= "state">
			<?php
                echo "hello! ".$row[0];
            ?>
            <button onclick="logout();">[登出?]</button>
		</div>
        
		<!--<div class = "header2">-->
			<!--<a href="CA_home.php">出納人員系統</a></h1>--><!--小標-->
		<!--</div>-->
        
		<!--選單-->
		<!---->
        <div class="content">
        <div class=title>修改帳號</div>
        <div class="announce">
        <table border=1 width="100%">
            <tr>
                <td align=center>帳號</td>
                <td align=center>密碼</td>
                <td align=center>姓名</td>
                <td align=center>電話</td>
                <td align=center>E-mail</td>
                <td align=center>類型</td>
                <td align=center>學號或員工編號</td>
                <td align=center>身分證字號</td>
                <td style="text-align: center;">資料修改</td>
            </tr>
            <?php
                include("../connect.php");
                $sql = "SELECT * from `user`";
                $result = $sql_qry->query($sql);
                /*echo"<table border=1 width=100%>";
                    echo"<tr>";
                    echo"<td align=center>帳號";
                    echo"<td align=center>密碼";
                    echo"<td align=center>姓名";
                    echo"<td align=center>電話";
                    echo"<td align=center>E-mail";
                    echo"<td align=center>類型";
                    echo"<td align=center>學號或員工編號";
                    echo"<td align=center>身分證字號";
                    echo"</tr>";*/

                while($row = $result->fetch(PDO::FETCH_NUM)){
                    if($row[0]){
                        echo"<tr>";
                        echo"<td align=center>".$row[0];
                        echo"<td align=center>".$row[1];
                        echo"<td align=center>".$row[2];
                        echo"<td align=center>".$row[3];
                        echo"<td align=center>".$row[4];
                        if($row[5]==0)
                            echo"<td align=center>".'一般使用者';
                        else if($row[5]==1)
                            echo"<td align=center>".'系統管理員';
                        else if($row[5]==2)
                            echo"<td align=center>".'出納人員';
                        else if($row[5]==3)
                            echo"<td align=center>".'場地管理員';
                        
                        echo"<td align=center>".$row[6];
                        echo"<td align=center>".$row[7];
                        echo"<td align=center><a href=mod_acc.php?id=$row[0]>修改</td>";
                        echo"</tr>";
                    }
                    else{
                        echo "沒有資料";
                        break;
                    }
                }
                echo "</table>";
            ?>
        </table>
        </div>
        </div>

		<!---<img id="slider" src="1.jpg">
		<div class="announcement">
			<a>系統公告</a>
		
			<div class="title">
				<a href="">早安午安晚安</a>
				
			</div>
		</div>--->
		


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
