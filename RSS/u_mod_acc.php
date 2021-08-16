<?php include("../login_check.php");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/txt.css">
		<link rel="stylesheet" href="../css/home.css">
		<title>修改帳號資料</title>
	</head>

    <style>
        tr{
            text-align:center;
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

<div class="content">
            <div class="title">修改使用者帳號資料</div>
            <div class="announce">
            <center>
            <p>此處可修改帳號基本資料，可更動欄位包含:姓名、連絡電話、電子郵件。</p>

<?php
	    include("../connect.php");//連接到資料庫
   
        //session_start();//啟用session
        if(isset($_SESSION['account'])){
            $getName=$_SESSION['account'];
            //此處使用php7，注意sql語法
            $sql_query="select * from user where account='{$getName}'";
            $result=mysqli_query($link,$sql_query);
            $row=mysqli_fetch_array($result);
	
            echo '<form method="POST" action="u_mod_acc_act.php">';//使用者送出的資料將在當前頁面進行處理
            echo '<table  border="1px">';
                echo '<tr>';
                    echo '<td><label for="usr_acc">使用者帳號：</label></td>';
                    echo '<td>'.$row[0].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><label for="usr_name">姓名：</label></td>';
                    echo '<td><input type="text" name="usr_name" id="usr_name" value="'.$row[2].'"</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><label for="usr_tel">連絡電話：</label></td>';
                    echo '<td><input type="text" name="usr_tel" id="usr_tel" value="'.$row[3].'"</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><label for="usr_email">電子郵件：</label></td>';
                    echo '<td><input type="email" name="usr_email" id="usr_email" value="'.$row[4].'"</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><label for="usr_type">身分別：</label></td>';
                    if(empty($row[5])){
                        echo "<td>一般使用者</td>";
                    }
                    else if((int)$row[5]===1){
                        echo "<td>系統管理員</td>";
                    }
                    else if((int)$row[5]===2){
                        echo "<td>出納人員</td>";
                    }
                    else if((int)$row[5]===3){
                        echo "<td>場地管理員</td>";
                    }
                echo '</tr>';
                echo '<tr>';
                    echo '<td><label for="usr_id">身分證字號：</label></td>';
                    echo '<td>'.$row[6].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><label for="usr_num">學號/教職員編號：</label></td>';
                    echo '<td>'.$row[7].'</td>';
                echo '</tr>';
            echo '</table>';
            echo '<input type="submit" value="送出" id="mod_acc_btn" name="mod_acc_btn">';
            echo '</form>';
         }
?>
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