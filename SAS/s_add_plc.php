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
				$dick=$row[0];
            ?>
            <button onclick="logout();">[登出?]</button>
		</div>

		<div class="content">
		<div class=title>新增場地</div>
        <div class="announce">
        <DIV class="center" align="center">
            <form method="post">
                <table border=0 width="50%" align="center">

                    <!--<h2>學生登入</h2>-->

                    <tr>
                        <td width=30% align="right">類型:</td>
                        <td align="left">
                            <select name="type" style="font-size:20px;">
                                <option value="0" selected>烤肉爐</option>
                                <option value="1">露營區</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width=30% align="right">校內價錢:</td>
                        <td align="left"><input type="text" name="money_school" size=50 required></td>
                    </tr>
                    <tr>
                        <td width=30% align="right">校外價錢:</td>
                        <td align="left"><input type="text" name="money_outside" size=50 required></td>
                    </tr>
                    <tr>
                        <td colspan=2 align="center">
                            <input type="submit" value="新增" name="sub" size=20>
                            <input type="reset" value="重新輸入" size=20>
                        </td>
                    </tr>
                </table>
            </form>
        </DIV>
		</div>
		</div>

        <?php
        include("../connect.php");
        if (isset($_POST["sub"])) {
            session_start();
            $type = $_POST["type"];
            $money_school = $_POST["money_school"];
            $money_outside = $_POST["money_outside"];

            $sql = "SELECT MAX(`place_id`) FROM `place`";
            $result = $sql_qry->query($sql);
            $row = $result->fetch(PDO::FETCH_NUM);
            $row[0] = $row[0] + 1;
            $sql = "INSERT INTO `place`(`place_id`,`type`,`money_school`,`money_outside`) VALUES('".$row[0]."','".$type."','".$money_school."','".$money_outside."')";

            if($sql_qry->exec($sql))
                echo "<script> alert('新增成功');history.back();</script>";
            else
                echo "<script> alert('新增錯誤');history.back();</script>";
        }
        ?>
        
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