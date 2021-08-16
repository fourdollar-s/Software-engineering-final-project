<!--使用者修改申請-->
<?php include("../login_check.php");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/txt.css">
		<link rel="stylesheet" href="../css/home.css">
		<title>修改申請</title>
	</head>

    <style>
        tr{
            text-align:center;
        }
    </style>

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

            <div class="title">修改申請</div>
            <div class="announce">
            <p>只有未完成(含未審核與未繳費)的申請可進行修改。</p>
            <center>

<?php
    //if (!isset($_SESSION)){session_start();}//啟用session
	include("../connect.php");//連接到資料庫
   
    if(isset($_SESSION['account'])){
        $getName=$_SESSION['account'];
    }

        #取得此使用者帳號所有的申請
        $all_app="SELECT * FROM `record` WHERE `account`='{$getName}' AND (`state`=0 OR `state`=1)";#只能修改未完成的
        $app=mysqli_query($link,$all_app);
        echo "<table  border='1px'>";
            echo "<tr>";
                echo "<td>申請編號</td>";
                echo "<td>申請狀態</td>";
                echo "<td>申請金額</td>";
                echo "<td>申請單位</td>";
                echo "<td>申請日期</td>";
                echo "<td>烤肉台數量</td>";
                echo "<td>露營區數量</td>";
            echo "</tr>";
        while($result=mysqli_fetch_assoc($app)){#尋訪，條列出每筆申請
                echo "<tr>";
                    echo "<td>".$result['record_id']."</td>";
                    if(empty($result['state'])){
                        echo "<td>審核中</td>";
                    }
                    else if((int)$result['state']===1){
                        echo "<td>繳費中</td>";
                    }
                    else if((int)$result['state']===2){
                        echo "<td>完成</td>";
                    }
                    else if((int)$result['state']===3){
                        echo "<td>審核失敗</td>";
                    }
                    else if((int)$result['state']===4){
                        echo "<td>逾期未繳</td>";
                    }
                    else if((int)$result['state']===5){
                        echo "<td>取消申請</td>";
                    }
                    echo "<td>".$result['money']."</td>";
                    echo "<td>".$result['organization']."</td>";
                    echo "<td>".$result['apply_date']."</td>";
                    echo "<td>".$result['bbq_number']."</td>";
                    echo "<td>".$result['camp_number']."</td>";
                echo "</tr>";
        }
        echo "</table>";        
?>
<br>
<form method="POST" action="">
        <label for="mod_id">請選擇要修改的申請編號</label>
        <select name="mod_id" id="mod_id">
        <option value=''>選擇編號</option>
        <?php
            $all_app="SELECT * FROM `record` WHERE `account`='{$getName}' AND (`state`=0 OR `state`=1)";#只能取消未完成的
            $app=mysqli_query($link,$all_app);
            while($result2=mysqli_fetch_assoc($app)){
                echo "<option value=".$result2['record_id'].">".$result2['record_id']."</option>";
            }
        ?>
        </select>
        <input type="submit" value="submit" id="mod_btn" name="mod_btn">
</form>

<?php
    if(isset($_POST["mod_btn"])){#使用者按下submit後
        
        if(isset($_POST["mod_id"])){
            $_SESSION["MID"]=$_POST["mod_id"];
            #刪除apply中此申請租借的場地
            $mid=$_SESSION["MID"];
            $app_place="DELETE FROM `apply` WHERE `record_id`='{$mid}'";
            mysqli_query($link,$app_place);
        }

        echo "<script type='text/javascript'>";
        echo "window.location.href='u_mod_app_act.php'";
        echo "</script>";
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