<?php include("../login_check.php");?>
<?php include("../connect.php");
 $place_id = $_GET["id"];
 $sql = "SELECT * FROM `place` WHERE `place_id`='".$place_id."' ";
 $result = $sql_qry->query($sql);
 $row = $result->fetch(PDO::FETCH_NUM);

 /*$account = $_GET["row[0]"];
 $sql = "SELECT * FROM `user` WHERE `account`='".$account."' ";
 $result = $sql_qry->query($sql);
 $row = $result->fetch(PDO::FETCH_NUM);

 if(isset($_POST['sub']) ){


    //$time = date('Y/m/d H:i:s');  
    //$title = $_POST["title"];
    //$content = $_POST["content"];
    //echo $id."<br>";
    //echo $time."<br>";
    //echo $title."<br>";
    //echo $content."<br>";
    //`time`= '".$time."' ,
    $sql = "UPDATE `announcement`
            SET `title`= '".$title."' , `content` = '".$content."'
            WHERE `id`=".$id;
	if($ann[0] == $title && $ann[1] == $content){
		echo "<script> alert('內容並未修改喔!'); history.back();</script>";
		exit();
	}
    if ($sql_qry->exec($sql)) {
        echo "<script> alert('修改成功');</script>";
        echo "<script> document.location.href='SA.php';</script>";
    } 
    else{
        echo "<script> alert('修改失敗');</script>";
    }

}*/

?>
    
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



		<div class="content">
			<div class="title">
			<p>修改場地</p>
			</div>
			<div class="announce">
			
			<DIV class="center" align="center">
            <form method="post">
                <table border=0 width="50%" align="center">

                    <!--<h2>學生登入</h2>-->
                    <tr>
                        <td width=30% align="right">修改類型:</td>
                        <td align="left">
                            <select name="type" style="font-size:20px;">
                                <option value="0" <?php if($row[1] == 0) echo "selected";?>>烤肉爐</option>
                                <option value="1" <?php if($row[1] == 1) echo "selected";?>>露營區</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width=30% align="right">修改校內價錢:</td>
                        <td align="left"><input type="number" name="money_school" size=50 value=<?php echo $row[2];?>></td>
                    </tr>   
                    <tr>
                        <td width=30% align="right">修改校外價錢:</td>
                        <td align="left"><input type="number" name="money_outside" size=50 value=<?php echo $row[3];?>></td>
                    </tr>
                    <tr>
                        <td colspan=2 align="center">
                            <input type="submit" value="確認修改" name="sub" size=20>
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
        //接收前端輸入資料 
        if (isset($_POST["sub"])) {  
            $type = $_POST["type"];
            $money_school = $_POST["money_school"];
            $money_outside = $_POST["money_outside"];

            if ($type != "") {
                $sql = "UPDATE `place` SET `type`= '".$type."' WHERE `place_id`='".$place_id."'";
                $sql_qry->exec($sql);
            }
            if ($money_school != "") {
                $sql = "UPDATE `place` SET `money_school`= '".$money_school."' WHERE `place_id`='".$place_id."'";
                $sql_qry->exec($sql);
            }
            if ($money_outside != "") {
                $sql = "UPDATE `place` SET `money_outside`= '".$money_outside."' WHERE `place_id`='".$place_id."'";
                $sql_qry->exec($sql);
            }             
            echo "<script> alert('修改成功');document.location.href='s_mod_plc.php';</script>";
        }
        ?>
  <!---<img id="slider" src="1.jpg">
  <div class="announcement">
   <a>系統公告</a>
  
   <div class="title">
    <a href="">早安午安晚安</a>
    
   </div>
  </div>--->
 
                
			</div>
            <a href="s_mod_plc.php">上一頁</a>
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
