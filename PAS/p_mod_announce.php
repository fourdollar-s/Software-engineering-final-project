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
		<?php include("header.php");?>
		
		<div class= "state">
			<?php
                echo "hello! ".$row[0];
            ?>
            <button onclick="logout();">[登出?]</button>
		</div>

		<div class="content">
        <div class="title">
    <p>修改公告</p>
    </div>
    <div class="announce">
        <table border=1 width="100%">
            <tr>
                <td width="15%">發布人</td>
                <td width="35%">發布日期</td>
                <td width="40%">標題</td>
                <td width="10%" style="text-align: center;">資料修改</td>
            </tr>
            
            <?php
                include("../connect.php");
                $sql = "SELECT `id`,`type`,`time`,`title` FROM `announcement`,`user` 
                    WHERE `announcer`=`account` AND `type` = 3 ORDER BY `time` DESC";
                $result = $sql_qry->query($sql);
                while($row1 = $result->fetch(PDO::FETCH_NUM)){
                    if($row1[1]==1){
                        $announcer = "系統管理員";
                    }
                    elseif($row1[1]==2){
                        $announcer = "出納人員";
                    }
                    elseif($row1[1]==3){
                        $announcer = "場地管理員";
                    }
                    echo '
                    <tr>
                        <td>'.$announcer.'</td>
                        <td>'.$row1[2].'</td>
                        <td><a href="announce.php?id='.$row1[0].'">'.$row1[3].'</td>
                        <td style="text-align: center;"><a href="mod_announce.php?id='.$row1[0].'">修改</td>
                    </tr>
                    ';
                }
            ?>
        </table>
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