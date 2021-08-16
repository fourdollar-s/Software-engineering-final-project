<?php include("../login_check.php");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/txt.css">
		<link rel="stylesheet" href="../css/home.css">
		<title>查看申請結果</title>
	</head>

    <style>
        tr{
            text-align:center;
        }
        .announce{
     /*位置*/
         margin-top: 2cm;
         margin-left: 10%;
         margin-right: 10%;
         height: 80%;
         padding: 1px;
     /*字體*/
         font-size: 0.5cm;
         color: #000000;
         text-align: center;
         line-height: 36px;
         letter-spacing: 2px;

         background-color: #ffffff;
     }
    .content {
        width: 100%;  
        height: 1100px; 
        text-align: center;
        background-color: #f3f3f3;
        border-top: solid;
        border-color: #f3f3f3;
    }
    </style>

    <body>
        <!--刪除session-->
        <?php
            
        ?>
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

            <div class="title">申請結果</div>
            <div class="announce">
            <p>此為剛剛送出的申請資料。</p>
            <center>
<?php
	include("../connect.php");//連接到資料庫
   
        //session_start();//啟用session

        //此處使用php7，注意sql語法
        #取得剛剛那筆資料的編號(必定是最新)
        $find_id="SELECT `record_id` FROM `record` ORDER BY `record_id` DESC LIMIT 1";
        $id=mysqli_fetch_row(mysqli_query($link,$find_id));

        #取出此筆資料的內容
        $sql_query="SELECT * FROM `record` WHERE `record_id`='{$id[0]}'";
        $result=mysqli_query($link,$sql_query);
        $row=mysqli_fetch_array($result);

        

        echo '<table  border="1px">';
            echo '<tr>';
                echo '<td>申請人帳號：</td>';
                echo '<td>'.$row[9].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>申請編號：</td>';
                echo '<td>'.$row[0].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>申請狀態：</td>';
                if(empty($row[1])){
                    echo "<td>審核中</td>";
                }
                else if($row[1]===1){
                    echo "<td>繳費中</td>";
                }
                else if($row[1]===2){
                    echo "<td>完成</td>";
                }
            echo '</tr>';
            echo '<tr>';
                echo '<td>總金額：</td>';
                echo '<td>'.$row[2].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>申請單位：</td>';
                echo '<td>'.$row[3].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>申請日期：</td>';
                echo '<td>'.$row[4].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>租借的烤肉台數量：</td>';
                echo '<td>'.$row[7].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>租借的烤肉台編號：</td>';
                echo '<td>';
                $sql_query_apply="SELECT * FROM `apply` WHERE `record_id`='{$id[0]}'";
                $result_apply=mysqli_query($link,$sql_query_apply);

                while($row_apply=mysqli_fetch_array($result_apply)){
                    $sql_query_place="SELECT * FROM `place` WHERE `place_id`='".$row_apply[0]."'";
                    $result_place=mysqli_query($link,$sql_query_place);
                    $row_place=mysqli_fetch_array($result_place);
                    if($row_place[1] == '0')
                        echo $row_apply[0].',';
                }
                echo '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>租借的露營區數量：</td>';
                echo '<td>'.$row[8].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>租借的露營區編號：</td>';
                echo '<td>';
                $sql_query_apply="SELECT * FROM `apply` WHERE `record_id`='{$id[0]}'";
                $result_apply=mysqli_query($link,$sql_query_apply);

                while($row_apply=mysqli_fetch_array($result_apply)){
                    $sql_query_place="SELECT * FROM `place` WHERE `place_id`='".$row_apply[0]."'";
                    $result_place=mysqli_query($link,$sql_query_place);
                    $row_place=mysqli_fetch_array($result_place);
                    if($row_place[1] == '1')
                        echo $row_apply[0].',';
                }
                echo '</td>';
            echo '</tr>';
        echo '</table>';
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