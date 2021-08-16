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
        <?php include("header.php");?>
		
		<div class= "state">
			<?php
                echo "hello! ".$row[0];
            ?>
            <button onclick="logout();">[登出?]</button>
		</div>

        <div class="content">
			<div class="title">
			    <p>申請細項</p>
			</div>
            <div class="announce">
            <?php
                include("../connect.php");
                if (isset($_POST["sub"])) {
                    $id = $_POST["id"];
                    $_SESSION['id'] = $id;
                
                    $sql = "SELECT * FROM `record` WHERE `record_id` = ". $id ." AND `state` = 0 OR `state` = 1 OR `state` = 3";
                    $result = $sql_qry->query($sql);
                    $row1 = $result->fetch(PDO::FETCH_ASSOC);
                    if(!$row1)
                        echo "<script> alert('error'); history.back(); </script>";
                    else {
                        echo "
                        <table border=1 width='100%' align='center'>
                        <tr align='center'>
                            <td> 申請編號 </td>
                            <td>".$row1['record_id']."</td>
                        </tr>
                        <tr align='center'>
                            <td> 應繳金額 </td>
                            <td>".$row1['money']."</td>
                        </tr>
                        <tr align='center'>    
                            <td> 申請日期 </td>
                            <td>".$row1['apply_date']."</td>
                        </tr>
                        <tr align='center'>    
                            <td> 烤肉爐數量 </td>
                            <td>".$row1['bbq_number']."</td>
                        </tr>
                        <tr align='center'>
                            <td> 露營區數量 </td>
                            <td>".$row1['camp_number']."</td>
                        </tr>
                        <tr align='center'>        
                            <td> 申請人帳號 </td>
                            <td>".$row1['account']."</td>
                        </tr>
                        <tr align='center'>    
                            <td> 申請人所屬單位 </td>
                            <td>".$row1['organization']."</td>
                        </tr>
                    
                        </table>";
                    }
                }
            ?>    
            <form method="POST" action="updateApplication.php">
                <tr>
                <input type="radio" value="yes" name="verification" required>通過
                <input type="radio" value="no" name="verification" required>不通過
                </tr>
                <tr>
                    <td colspan=2 ><input type="submit" value="送出" name="sub" size=20> </td>
                </tr>
            </form>
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