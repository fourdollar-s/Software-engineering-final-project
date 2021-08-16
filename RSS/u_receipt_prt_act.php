<?php include("../login_check.php");?>
<html>
<head>
    <title>收據</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/txt.css">
<link rel="stylesheet" href="../css/home.css"> 
</head>

<style>
        tr{
            text-align:center;
        }
        .content {
        width: 100%;  
        height: 1000px; 
        text-align: center;
        background-color: #f3f3f3;
        border-top: solid;
        border-color: #f3f3f3;
    }
    </style>
    
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script  src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script type="text/javascript">    
    function screenshot(){
        var doc = new jsPDF();
                html2canvas(document.getElementById('print')).then(function(canvas) {
                    document.body.appendChild(canvas);
                        var a= canvas.toDataURL("image/jpeg");
                        doc.addImage(a, 'JPEG', 0, 0, canvas.width/7, canvas.height/7);
                        doc.save('receipt.pdf');
                        location.reload();
                        //a.click();
                });

    }
    </script>
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

<div class="content">

    <input type="button" value="下載" onclick="screenshot()">
<?php
    include("../connect.php");

    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    # 取得日期與時間（新時區）
    $time_now = date('Y/m/d');
    $time_array = explode("/",$time_now);
    $time_taiwan = $time_array[0]-1911;
    $time = "中華民國".$time_taiwan."年".$time_array[1]."月".$time_array[2]."日(".$time_array[1].".".$time_array[2].".".$time_array[0].")";

    $id = $_POST["receipt_id"];#申請單編號
    $sql_query="SELECT * FROM `record` WHERE `record_id`='{$id}'";
    $result=mysqli_fetch_assoc(mysqli_query($link,$sql_query));#取得此編號所有資料

    $sql_query="SELECT * FROM `user` WHERE `account`='{$result['account']}'";
    $result2=mysqli_fetch_assoc(mysqli_query($link,$sql_query));#取得此帳號所有資料
?>

    <div id="print">
        <img src="../pic/nuk.jpg" style="margin: 0px 50px 0px 180px;">高大收入字第 <?php echo $id;?> 號 <br>
        <br><p style="margin: 0px 0px 0px 300px;">自行收納款項統一收據</p>
        <p style="margin: 0px 0px 0px 250px;"><?php echo $time;?></p>
        <table border = 1 width = 800px height = 200px>
            <tr>
            <td>繳款人<br>PAID BY</td>
            <td>收入科目及代號<br>REVENUS ACCOUNT</td>
            <td>金額<br>AMOUNT</td>
            <td>事由<br>PURPOSE</td>
            </tr>
            
            <tr height = 150px>
            <td>國立高雄大學<?php echo $result2['name']; ?></td>
            <td></td>
            <td> <?php echo 'NT$'.$result['money']; ?> </td>
            <td>租借露營區/烤肉區</td>
            </tr>
    
            <tr>
            <td>金額</td>
            <td colspan="3">新台幣 <?php echo $result['money']; ?> 元整
            </tr>
        </table>
    
        <table width = 800px>
            <tr>
                <td>經手人<br>WALLA</td>
                <td>主辦出納<br>CHIEF CASHIER</td>
                <td>主辦會計<br>CHIEF<br>ACCOUNTANT</td>
                <td>機關長官<br>PRESIDENT</td>
            </tr>
        </table>
        <p>
        本收據未經經手人蓋章無效<br>第一聯:收執聯(繳款人收執)<br>
        -------------------------------------------------------------------------------------------------------------------------------------------------------
        </p>
        <table border = 1 width = 800px height = 200px>
            <tr>
            <td>繳款人<br>PAID BY</td>
            <td>收入科目及代號<br>REVENUS ACCOUNT</td>
            <td>金額<br>AMOUNT</td>
            <td>事由<br>PURPOSE</td>
            </tr>
            
            <tr height = 150px>
            <td>國立高雄大學<?php echo $result2['name']; ?></td>
            <td></td>
            <td> <?php echo 'NT$'.$result['money']; ?> </td>
            <td>租借露營區/烤肉區</td>
            </tr>
    
            <tr>
            <td>金額</td>
            <td colspan="3">新台幣 <?php echo $result['money']; ?> 元整
            </tr>
        </table>
    
        <table width = 800px>
            <tr>
                <td>經手人<br>WALLA</td>
                <td>主辦出納<br>CHIEF CASHIER</td>
                <td>主辦會計<br>CHIEF<br>ACCOUNTANT</td>
                <td>機關長官<br>PRESIDENT</td>
            </tr>
        </table>
        <p>
        本收據未經經手人蓋章無效<br>第二聯:收執聯(收款人收執)<br>
        </p>
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