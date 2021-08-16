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
			    <p>場地狀態</p>
			</div>
            <div class="announce">
            <?php
                include("../connect.php");
                
                
                if (isset($_POST["sub"])) {
                    $date = $_POST['date'];
                    if(!$date){
                        echo "<script> alert('error'); history.back(); </script>";
                        exit();
                    }
                    $datet = strtotime($date);
                    $sql = "SELECT * FROM `record` natural join `apply`";// AND" .$new_date. "<= `time_finish`";
                    $result = $sql_qry->query($sql);
        
                    echo "
                    <table border=1 width='100%' align='center'>
                    <tr align='center'>
                        <td> 場地編號 </td>
                        <td> 狀態 </td>
                        <td> 開始時間 </td>
                        <td> 結束時間 </td>
                    </tr>";

                    $flag = false;
                    while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
                        if(strtotime($row1['time_start']) <= $datet+86400 && strtotime($row1['time_finish']) >= $datet){
                            $flag = true;
                            echo "
                                <tr align='center'>
                                <td>".$row1['place_id']."</td>
                                ";
                                $state;
                                switch($row1['state']){
                                    case '0': $state = "審核中"; break;
                                    case '1': $state = "繳費中"; break;
                                    case '2': $state = "完成"; break;
                                    case '3': $state = "審核失敗"; break;
                                    case '4': $state = "逾期未繳"; break;
                                    case '5': $state = "取消申請"; break;
                                    default: $state = "Unknown";
                                }
                                
                                echo "
                                    <td>".$state."</td>
                                    <td>".$row1['time_start']."</td>
                                    <td>".$row1['time_finish']."</td>";
                                
                                
                                echo "</tr>";


                        }
                    }
                    if($flag == false){
                        echo "<script> alert('Not find'); history.back(); </script>";

                    }
                }
                echo "</table>";
            ?>
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