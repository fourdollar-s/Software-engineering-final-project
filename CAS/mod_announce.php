<?php include("../login_check.php");?>
<?php include("../connect.php");
 $id = $_GET["id"];
 $sql = "SELECT `title`,`content` FROM `announcement` WHERE `id`=".$id." ";
 $result = $sql_qry->query($sql);
 $ann = $result->fetch(PDO::FETCH_NUM);

 if(isset($_POST['sub']) ){


    //$time = date('Y/m/d H:i:s');  
    $title = $_POST["title"];
    $content = $_POST["content"];
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
        echo "<script> document.location.href='CA.php';</script>";
    } 
    else{
        echo "<script> alert('修改失敗');</script>";
    }

}

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
                <form method="POST" action="">
                <h3>Title</h3>
                <input type="text" size="50" name="title" required maxlength="1000" value="<?php echo $ann[0];?>"></input><br>
                <h3>Content</h3>
                <div class="text_area">
                    <textarea name="content"
                    style="font-size:20px;width:500px;height:300px;"
                    maxlength="1000"
                    required
                        ><?php  echo $ann[1];?></textarea> 
               
                </div>
                
                <input type="submit" name="sub" value="送出" style="width:100px;">
                <input type="reset" style="width:100px;">
                
                </form>
                    
                
			</div>
            <a href="c_mod_announce.php">上一頁</a>
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
