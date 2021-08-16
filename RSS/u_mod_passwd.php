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
            <div class="title">修改密碼</div>
            <div class="announce">
            <p>此處可更改此帳號之密碼，請注意更改完後須用新密碼重新進行登入。</p>
            <center>

<?php
	    include("../connect.php");//連接到資料庫
   
        //session_start();//啟用session
        if(isset($_SESSION['account'])){
            $getName=$_SESSION['account'];
        }

        //此處使用php7，注意sql語法
        $sql_query="select * from user where account='{$getName}'";
        $result=mysqli_query($link,$sql_query);
        $row=mysqli_fetch_array($result);
?>
	
        <form method="GET" action="">
        <table>
            <tr>
                <td><label for="new_passwd">新的密碼：</label></td>
                <td><input type="password" name="new_passwd" id="new_passwd"></td>
            </tr>
            <tr>
                <td><label for="new_passwd_repeat">確認新的密碼：</label></td>
                <td><input type="password" name="new_passwd_repeat" id="new_passwd_repeat"></td>
            </tr>
        </table>
        <input type="submit" value="mod" id="mod_pswd_btn" name="mod_pswd_btn">
        </form>

<?php
    if(isset($_GET["mod_pswd_btn"])){
        $pswd=$_GET["new_passwd"];
        $repeat=$_GET["new_passwd_repeat"];

        if($pswd==$repeat){
            $mod="UPDATE user SET `password`='{$pswd}' WHERE `account`='{$getName}'";
            $result= mysqli_query($link,$mod);
            if($result){
            echo "<script>document.location.href='../logout.php';</script>";
            echo "<script>alert('修改資料成功')</script>";
            }
        }
        else{
            echo "<script>alert('密碼不相符')</script>";
        }
        
    }
?>
</center>
</div>
</div><!--content-->

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