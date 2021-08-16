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
			<p>新增公告</p>
			</div>
			<div class="announce">
                <form method="post" action="">
                <h3>Title</h3>
                <input type="text" size="50" name="title" required maxlength="1000" placeholder="請輸入標題"></input><br>
                <h3>Content</h3>
                <div class="text_area">
                    <textarea name="content"
                    style="font-size:20px;width:500px;height:300px;"
                    maxlength="1000"
                    required
                        >輸入內容</textarea> 
               
                </div>
                <input type="submit" name="sub" value="送出" style="width:100px; text-align:center;">
                <input type="reset" style="width:100px;text-align:center;">
                
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
<?php
if(isset($_POST['sub']) ){
    $sql = "SELECT MAX(`id`),`announcer` FROM `announcement`";
    $result = $sql_qry->query($sql);
    $row = $result->fetch(PDO::FETCH_NUM);

    $id = $row[0] + 1;
    date_default_timezone_set('Asia/Taipei');
    $time = date('Y/m/d H:i:s');
    $title = $_POST["title"];
    $content = $_POST["content"];
    $announcer = $_SESSION['account'];

    $sql = "INSERT INTO announcement (`id`,`time`,`title`,`content`,`announcer`)
                VALUES ('".$id."', '".$time."', '".$title."','".$content."','".$announcer."')";
    if ($sql_qry->exec($sql)) {
        echo "<script> alert('新增成功');</script>";
        echo "<script> document.location.href='PA.php';</script>";
    } 
    else{
        echo "<script> alert('新增失敗');history.back();</script>";
    }
}

?>