<?php include("../login_check.php");?>
<!--
    沒有使用者啥都沒填就繳交的防呆機制(表單中所有欄位都為可null)
    系統需做的事情：
        獲取登入者帳號，並填入申請做為申請人
        計算此申請需付總金額
        分配可使用的場地給此申請
-->
<?php
    // if (!isset($_SESSION))
    // {
    //   session_start();
    // }//啟用session
    
    include("../connect.php");//連接資料庫
?>

<!-- <script language="text/javascript">
    window.document.body.onbeforeunload = function(){
        window.location.href='u_clear_session.php';
    }
</script> -->

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/txt.css">
<link rel="stylesheet" href="../css/home.css">
<title>場地租借申請</title>
</head>

<script>
window.onbeforeunload=function(){     
    　　if(<?php isset($_SESSION["CSD"])?>){
            <?php unset($_SESSION["CSD"]);?>
        }
        if(<?php isset($_SESSION["CST"])?>){
            <?php unset($_SESSION["CST"]);?>
        }
        if(<?php isset($_SESSION["CED"])?>){
            <?php unset($_SESSION["CED"]);?>
        }
        if(<?php isset($_SESSION["CET"])?>){
            <?php unset($_SESSION["CET"]);?>
        }
        if(<?php isset($_SESSION["CN"])?>){
            <?php unset($_SESSION["CN"]);?>
        }
        if(<?php isset($_SESSION["BSD"])?>){
            <?php unset($_SESSION["BSD"]);?>
        }
        if(<?php isset($_SESSION["BST"])?>){
            <?php unset($_SESSION["BST"]);?>
        }
        if(<?php isset($_SESSION["BED"])?>){
            <?php unset($_SESSION["BED"]);?>
        }
        if(<?php isset($_SESSION["BET"])?>){
            <?php unset($_SESSION["BET"]);?>
        }
        if(<?php isset($_SESSION["BN"])?>){
            <?php unset($_SESSION["BN"]);?>
        }
        if(<?php isset($_SESSION["OR"])?>){
            <?php unset($_SESSION["OR"]);?>
        }
} 
</script>


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

<body onbeforeunload="goodbye()">
<!--日期限制設定-->
<?php
    $SY=Date("Y");
    $SM=Date("m");
    $SD=Date("d")+7;
    $EY=Date("Y");
    $EM=Date("m");
    $ED=Date("d")+30;

    $S=FALSE;
    $E=FALSE;

    while(!$S||!$E){
        //開始
        if($SM==2&&(($SY%4==0&&$SY%100!=0)||($SY%400==0))){//閏年
            if($SD>29){
                $SM=$SM+1;
                $SD=($SD-29);
            }
        }
        else if($SM==2){//閏年
            if($SD>28){
                $SM=$SM+1;
                $SD=($SD-28);
            }
        }
        else if($SM==1||$SM==3||$SM==5||$SM==7||$SM==8||$SM==10||$SM==12){//大月
            if($SD>31){
                $SM=$SM+1;
                $SD=($SD-31);
            }
        }
        else {//小月
            if($SD>30){
                $SM=$SM+1;
                $SD=($SD-30);
            }
        }
        if($SM>12){
            $SY=$SY+1;
            $SM=1;
        }
        
        //結束
        if($EM==2&&(($EY%4==0&&$EY%100!=0)||($EY%400==0))){//閏年
            if($ED>29){
                $EM=$EM+1;
                $ED=($ED-29);
            }
        }
        else if($EM==2){//閏年
            if($ED>28){
                $EM=$EM+1;
                $ED=($ED-28);
            }
        }
        else if($EM==1||$EM==3||$EM==5||$EM==7||$EM==8||$EM==10||$EM==12){//大月
            if($ED>31){
                $EM=$EM+1;
                $ED=($ED-31);
            }
        }
        else {//小月
            if($ED>30){
                $EM=$EM+1;
                $ED=($ED-30);
            }
        }
        if($EM>12){
            $EY=$EY+1;
            $EM=1;
        }

        if($SM==2&&(($SY%4==0&&$SY%100!=0)||($SY%400==0))&&$SD<=29){
            $S=TRUE;
        }
        else if($SM==2&&$SD<=28){
            $S=TRUE;
        }
        else if(($SM==1||$SM==3||$SM==5||$SM==7||$SM==8||$SM==10||$SM==12)&&($SD<=31)){
            $S=TRUE;
        }
        else if($SD<=30){
            $S=TRUE;
        }

        if($EM==2&&(($EY%4==0&&$EY%100!=0)||($EY%400==0))&&$ED<=29){
            $E=TRUE;
        }
        else if($EM==2&&$ED<=28){
            $E=TRUE;
        }
        else if(($EM==1||$EM==3||$EM==5||$EM==7||$EM==8||$EM==10||$EM==12)&&($ED<=31)){
            $E=TRUE;
        }
        else if($ED<=30){
            $E=TRUE;
        }
    }
    

    $start_y=strval($SY);
    $start_m=strval($SM);
    if(strlen($start_m)==1){
        $start_m="0".$start_m;
    }
    $start_d=strval($SD);
    if(strlen($start_d)==1){
        $start_d="0".$start_d;
    }
    $end_y=strval($EY);
    $end_m=strval($EM);
    if(strlen($end_m)==1){
        $end_m="0".$end_m;
    }
    $end_d=strval($ED);
    if(strlen($end_d)==1){
        $end_d="0".$end_d;
    }//為後續能與資料庫中的datetime直接進行比較而進行的格是設定
?>

<!--session-->
<?php
    $flag_camp = false;
    $flag_bbq = false;
    if(isset($_GET["camp_start_date"])){
        $_SESSION["CSD"]=$_GET["camp_start_date"];
    }
    if(isset($_GET["camp_end_date"])){
        $_SESSION["CED"]=$_GET["camp_end_date"];
    }
    if(isset($_GET["camp_num"])){
        $_SESSION["CN"]=$_GET["camp_num"];
    }
    if(isset($_GET["bbq_start_date"])){
        $_SESSION["BSD"]=$_GET["bbq_start_date"];
    }
    if(isset($_GET["bbq_start_time"])){
        $_SESSION["BST"]=$_GET["bbq_start_time"];
    }
    // if(isset($_GET["bbq_end_date"])){
    //     $_SESSION["BED"]=$_GET["bbq_end_date"];
    // }
    if(isset($_GET["bbq_end_time"])){
        $_SESSION["BET"]=$_GET["bbq_end_time"];

    }
    if(isset($_GET["bbq_num"])){
        $_SESSION["BN"]=$_GET["bbq_num"];
    }
    if(isset($_GET["orginization"])){
        $_SESSION["OR"]=$_GET["orginization"];
    }
?>

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

        <div class="title">租借申請</div><br>
        <div class="announce">
        <p>租借規則:</p><br>
        <p>1. 可租借日期為今日算起七天後到三十天內。</p><br>
        <p>2. 露營區可跨日租借，烤肉台限當日租借。</p><br>
        <p>3. 露營區租借金額計算單位為天數。</p><br>
        <p>4. 烤肉區租借金額計算單位為一時段(4小時為一時段)。</p><br>
        <p>5. 系統會計算時段內可租借的露營區/烤肉台數量。</p><br>
        <center>

<!--申請表格-->
<form name="rent_form" id="rent_form" method="GET" action="">
<table>
    <tr>
        <td><label for="camp_start_date">露營區租借起始日期：</label></td>
        <td><input value="<?php echo isset($_SESSION['CSD'])?$_SESSION['CSD']:''; ?>" type="date" id="camp_start_date" name="camp_start_date" min="<?php echo $start_y?>-<?php echo $start_m?>-<?php echo $start_d?>" max="<?php echo $end_y?>-<?php echo $end_m?>-<?php echo $end_d?>"></td>
    </tr>
    <tr>
        <td><label for="camp_end_date">露營區租借結束日期：</label></td>
        <td><input value="<?php echo isset($_SESSION['CED'])?$_SESSION['CED']:''; ?>" type="date" id="camp_end_date" name="camp_end_date" min="<?php echo $start_y?>-<?php echo $start_m?>-<?php echo $start_d?>" max="<?php echo $end_y?>-<?php echo $end_m?>-<?php echo $end_d?>" onchange="document.rent_form.submit()"></td>
    </tr>
    <!--利用上面取得的日期進行判斷-->
    <tr>
        <td><label for="camp_num">露營區租借數量：</label></td>
        <td><select id="camp_num" name="camp_num">
                <option  value="<?php echo isset($_SESSION['CN'])?$_SESSION['CN']:'選擇租借數量'; ?>"></option>
                <?php
                    if((isset( $_SESSION["CSD"])&&isset( $_SESSION["CED"]))&&
                    (!empty( $_SESSION["CSD"])&&!empty( $_SESSION["CED"]))){//四個欄位皆有值才會進行計算

                        $CSDT=$_SESSION["CSD"]." 00:00:00";//將date與time合併成符合sql datetime格式的字串
                        $CEDT=$_SESSION["CED"]." 00:00:00";
                        if(strtotime($CSDT)>=strtotime($CEDT)){
                            echo "<script> alert('露營區時間選擇有誤');</script>";
                            if(isset($_SESSION["CSD"])){
                                unset($_SESSION["CSD"]);
                            }
                            if(isset($_SESSION["CED"])){
                                unset($_SESSION["CED"]);
                            }
                            $flag_camp = true;
                        }
                        else{
                            $flag_camp = false;
                        #計算不可使用的場地數量nuse=not use
                        /*$cal="SELECT COUNT(DISTINCT apply.place_id) as cmp_nuse
                        FROM `apply`
                        LEFT JOIN place 
                        ON place.place_id=apply.place_id 
                        WHERE (`place`.`type`=1) 
                        AND ((str_to_date('{$CSDT}','%Y-%m-%d %H:%i:%s') BETWEEN `time_start` AND `time_finish`) 
                        OR (str_to_date('{$CEDT}','%Y-%m-%d %H:%i:%s') BETWEEN `time_start` AND `time_finish`) 
                        OR (`time_start` BETWEEN str_to_date('{$CSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$CEDT}','%Y-%m-%d %H:%i:%s')) 
                        OR (`time_finish` BETWEEN str_to_date('{$CSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$CEDT}','%Y-%m-%d %H:%i:%s')))";
                        $data=mysqli_query($link,$cal);
                        $camp_not_use=mysqli_fetch_assoc($data);#取得值

                        #計算場地總數
                        $cal="SELECT COUNT(DISTINCT `place_id`) as cmp_sum FROM `place` WHERE `type`=1";
                        $data=mysqli_query($link,$cal);
                        $camp_sum=mysqli_fetch_assoc($data);#取得值

                        $cuse=$camp_sum["cmp_sum"]-$camp_not_use["cmp_nuse"];

                        while($cuse>=0){
                            echo "<option value=".$cuse.">".$cuse."</option>";
                            $cuse--;
                        }*/

                        $cont = 0;//能夠租借的場地數量
                        //$cal="SELECT COUNT(DISTINCT `apply`.`place_id`) as bbq_nuse FROM `place` JOIN `apply` WHERE `type`='bbq' AND `place`.`place_id`=`apply`.`place_id`";
                        $cal_place = "select * from place where type = '1'";//找出編號
                        $data_place=mysqli_query($link,$cal_place);
                        //echo 'row='.mysqli_num_rows($data_place).'<br>';
                        while($camp_place=mysqli_fetch_array($data_place)){//一個一個看編號
                            //2 = start
                            //3 = end
                            //echo $camp_place[0];
                            $flag = 1;
                            $cal_apply = "select * from apply where place_id ='".$camp_place[0]."'";//去apply看有沒有用到該場地編號
                            $data_apply=mysqli_query($link,$cal_apply);
                            if(mysqli_num_rows($data_place) != 0){
                                //apply裡有人申請過這個場地->去判斷時間有沒有疊到
                                while($camp_apply=mysqli_fetch_array($data_apply)){
                                    if(strtotime($camp_apply[2])>strtotime($CSDT) && strtotime($camp_apply[2])<strtotime($CEDT)){//已租借的開始時間夾在要申請的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $camp_place[0].'<br>';
                                    }
                                    else if(strtotime($camp_apply[3])>strtotime($CSDT) && strtotime($camp_apply[3])<strtotime($CEDT)){//已租借的結束時間夾在要申請的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $camp_place[0].'<br>';
                                    }
                                    else
                                        $flag = 1;
                                }
                            }
                            if($flag == 1){//沒有被疊到
                                $cal_available = "select * from available where place_id ='".$camp_place[0]."'";//去available看有沒有用到該場地編號
                                $data_available=mysqli_query($link,$cal_available);
                                while($camp_available=mysqli_fetch_array($data_available)){
                                    //echo "hello im in available table now";
                                    if(strtotime($camp_available[2])>strtotime($CSDT) && strtotime($camp_available[2])<strtotime($CEDT)){//已租借的開始時間夾在申請的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $camp_place[0].'<br>';
                                    }
                                    else if(strtotime($camp_available[3])>strtotime($CSDT) && strtotime($camp_available[3])<strtotime($CEDT)){//已租借的結束時間夾在申請的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $camp_place[0].'<br>';
                                    }
                                    else if(strtotime($camp_available[3])>strtotime($CSDT) && strtotime($camp_available[2])<strtotime($CSDT)){//申請的開始時間夾在已租借內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $camp_place[0].'<br>';
                                    }
                                    else if(strtotime($camp_available[3])>strtotime($CEDT) && strtotime($camp_available[2])<strtotime($CEDT)){//申請的結束時間夾在已租借內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $camp_place[0].'<br>';
                                    }
                                }
                                if($flag == 1){//都沒有疊到
                                    $cont++;//場地可用數量++
                                }
                            }
                        }
                        $num=0;
                        while($num<=$cont){
                            echo "<option value=".$num.">".$num."</option>";
                            $num++;
                        }
                        }
                    }
                ?>
            </select>
        </td>
    </tr>
    <!--使用者選擇完露營區日期-->
    <tr>
        <td><label for="bbq_start_date">烤肉台租借起始日期：</label></td>
        <td><input value="<?php echo isset($_SESSION['BSD'])?$_SESSION['BSD']:''; ?>" type="date" id="bbq_start_date" name="bbq_start_date" min="<?php echo $start_y?>-<?php echo $start_m?>-<?php echo $start_d?>" max="<?php echo $end_y?>-<?php echo $end_m?>-<?php echo $end_d?>"></td>
    </tr>
    <tr>
        <td><label for="bbq_start_time">烤肉台租借起始時間：</label></td>
        <td><input value="<?php echo isset($_SESSION['BST'])?$_SESSION['BST']:''; ?>" type="time" id="bbq_start_time" name="bbq_start_time"></td>
    </tr>
    <!-- <tr>
        <td><label for="bbq_end_date">烤肉台租借結束日期：</label></td>
        <td><input value="<?php #echo isset($_SESSION['BED'])?$_SESSION['BED']:''; ?>" type="date" id="bbq_end_date" name="bbq_end_date" min="<?php #echo $start_y?>-<?php #echo $start_m?>-<?php #echo $start_d?>" max="<?php #echo $end_y?>-<?php #echo $end_m?>-<?php #echo $end_d?>"></td>
    </tr> -->
    <tr>
        <td><label for="bbq_end_time">烤肉台租借結束時間：</label></td>
        <td><input value="<?php echo isset($_SESSION['BET'])?$_SESSION['BET']:''; ?>" type="time" id="bbq_end_time" name="bbq_end_time"  onchange="document.rent_form.submit()"></td>
    </tr>
    <!--利用上面取得的日期進行判斷-->
    <tr>
        <td><label for="bbq_num">烤肉台租借數量：</label></td>
        <td><select id="bbq_num" name="bbq_num">
                <option value="<?php echo isset($_SESSION['BN'])?$_SESSION['BN']:'選擇租借數量'; ?>"></option>
            
                <?php
                    if((isset( $_SESSION["BSD"])&&isset( $_SESSION["BST"])&&isset( $_SESSION["BET"]))&&
                    (!empty( $_SESSION["BSD"])&&!empty( $_SESSION["BST"])&&!empty( $_SESSION["BET"]))){//四個欄位皆有值才會進行計算
                        #&&isset( $_SESSION["BED"])
                        $BSDT=$_SESSION["BSD"]." ".$_SESSION["BST"].":00";//將date與time合併成符合sql datetime格式的字串
                        $BEDT=$_SESSION["BSD"]." ".$_SESSION["BET"].":00";
                        if(strtotime($_SESSION["BST"])>strtotime($_SESSION["BET"])){
                            echo "<script> alert('烤肉台時間選擇有誤');</script>";
                            if(isset($_SESSION["BSD"])){
                                unset($_SESSION["BSD"]);
                            }
                            if(isset($_SESSION["BST"])){
                                unset($_SESSION["BST"]);
                            }
                            if(isset($_SESSION["BED"])){
                                unset($_SESSION["BED"]);
                            }
                            if(isset($_SESSION["BET"])){
                                unset($_SESSION["BET"]);
                            }
                            $flag_bbq = true;
                        }
                        else{
                            $flag_bbq = false;
                        #計算不可使用的場地數量nuse=not use
                        /*$cal="SELECT COUNT(DISTINCT apply.place_id) as bbq_nuse
                        FROM apply 
                        LEFT JOIN place 
                        ON place.place_id=apply.place_id 
                        WHERE (`place`.`type`=0)
                        AND ((str_to_date('{$BSDT}','%Y-%m-%d %H:%i:%s') BETWEEN `time_start` AND `time_finish`) 
                        OR (str_to_date('{$BEDT}','%Y-%m-%d %H:%i:%s') BETWEEN `time_start` AND `time_finish`) 
                        OR (`time_start` BETWEEN str_to_date('{$BSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$BEDT}','%Y-%m-%d %H:%i:%s')) 
                        OR (`time_finish` BETWEEN str_to_date('{$BSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$BEDT}','%Y-%m-%d %H:%i:%s')))";
                        $data=mysqli_query($link,$cal);
                        $bbq_not_use=mysqli_fetch_assoc($data);#取得值

                        #計算場地總數
                        $cal="SELECT COUNT(DISTINCT `place_id`) as bbq_sum FROM `place` WHERE `type`=0";
                        $data=mysqli_query($link,$cal);
                        $bbq_sum=mysqli_fetch_assoc($data);#取得值

                        $buse=$bbq_sum["bbq_sum"]-$bbq_not_use["bbq_nuse"];

                        while($buse>=0){
                            echo "<option value=".$buse.">".$buse."</option>";
                            $buse--;
                        }*/
                        $cont = 0;//能夠租借的場地數量
                        //$cal="SELECT COUNT(DISTINCT `apply`.`place_id`) as bbq_nuse FROM `place` JOIN `apply` WHERE `type`='bbq' AND `place`.`place_id`=`apply`.`place_id`";
                        $cal_place = "select * from place where type = '0'";//找出編號
                        $data_place=mysqli_query($link,$cal_place);
                        //echo 'row='.mysqli_num_rows($data_place).'<br>';
                        while($bbq_place=mysqli_fetch_array($data_place)){//一個一個看編號
                            //2 = start
                            //3 = end
                            //echo $camp_place[0];
                            $flag = 1;
                            $cal_apply = "select * from apply where place_id ='".$bbq_place[0]."'";//去apply看有沒有用到該場地編號
                            $data_apply=mysqli_query($link,$cal_apply);
                            if(mysqli_num_rows($data_place) != 0){
                                //apply裡有人申請過這個場地->去判斷時間有沒有疊到
                                while($bbq_apply=mysqli_fetch_array($data_apply)){
                                    if(strtotime($bbq_apply[2])<strtotime($BEDT) && strtotime($bbq_apply[2])>strtotime($BSDT)){//結束時間比已租借的開始時間晚
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        echo $bbq_place[0].'<br>';
                                    }
                                    else if(strtotime($bbq_apply[3])<strtotime($BEDT) && strtotime($bbq_apply[3])>strtotime($BSDT)){//開始時間比已租借的結束時間早
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        echo $bbq_place[0].'<br>';
                                    }
                                    else
                                        $flag = 1;
                                }
                            }
                            if($flag == 1){//沒有被疊到
                                $cal_available = "select * from available where place_id ='".$bbq_place[0]."'";//去available看有沒有用到該場地編號
                                $data_available=mysqli_query($link,$cal_available);
                                while($bbq_available=mysqli_fetch_array($data_available)){
                                    //echo "hello im in available table now";
                                    //echo $bbq_place[0].'<br>';
                                    //echo "a start:".strtotime($bbq_available[2])."<br>";
                                    //echo "want start:".strtotime($BSDT)."<br>";
                                    //echo "a end:".strtotime($bbq_available[3])."<br>";
                                    //echo "want end:".strtotime($BEDT)."<br><br>";
                                    if(strtotime($bbq_available[2])<strtotime($BEDT) && strtotime($bbq_available[2])>strtotime($BSDT)){//已租借的開始時間夾在要申請的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $bbq_place[0].'<br>';
                                    }
                                    else if(strtotime($bbq_available[3])<strtotime($BEDT) && strtotime($bbq_available[3])>strtotime($BSDT)){//已租借的結束時間夾在要申請的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $bbq_place[0].'<br>';
                                    }
                                    else if(strtotime($bbq_available[3])>strtotime($BEDT) && strtotime($bbq_available[2])<strtotime($BEDT)){//要申請的結束時間夾在已租借的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $bbq_place[0].'<br>';
                                    }
                                    else if(strtotime($bbq_available[3])>strtotime($BSDT) && strtotime($bbq_available[2])<strtotime($BSDT)){//要申請的開始時間夾在已租借的時間內
                                        $flag = 0;
                                        break;//任一個疊到就不用繼續判斷了
                                        //echo $bbq_place[0].'<br>';
                                    }
                                }
                                if($flag == 1){//都沒有疊到
                                    $cont++;//場地可用數量++
                                }
                            }
                        }
                        $num=0;
                        while($num<=$cont){
                            echo "<option value=".$num.">".$num."</option>";
                            $num++;
                        }
                        }
                    }
                ?>
            </select>
        </td>
    </tr>
    <!--烤肉台部分結束-->
    <!--申請單位-->
    <tr>
        <td><label for="orginization">申請單位：</label></td>
        <td><input type="text" id="orginization" name="orginization"></td>
    </tr>
</table>
    <br>
    <?php if($flag_camp == false && $flag_bbq == false){ ?>
            <input type="submit" id="submitBTN" name="submitBTN" value="submit">
    <?php } ?>
</form>
</center>
</div>
<!--表單結束-->
</div><!--content-->

<!--使用者送出表單-->
<?php
    if(isset($_GET["submitBTN"])){
        #echo "csdt= ".$CSDT."<br>";
        #echo "cedt= ".$CEDT."<br>";

        if(isset($_SESSION['account'])){
            $getName=$_SESSION['account'];
        }

        #取得最新一筆申請的編號
        $find_rid="SELECT `record_id` FROM `record` ORDER BY `record_id` DESC LIMIT 1";
        $last_rid=mysqli_fetch_row(mysqli_query($link,$find_rid));

        if($last_rid==NULL){#目前沒有任何申請紀錄
            $lrid=1;
        }
        else{
            $lrid=$last_rid[0]+1;
        }

        $SY=Date("Y");
        $SM=Date("m");
        $SD=Date("d");//獲得今日日期

        $D=$SY."-".$SM."-".$SD;

        $ORI=$_SESSION["OR"];
        $BN=(int)$_SESSION["BN"];#要給此申請的烤肉台數量
        $CN=(int)$_SESSION["CN"];#要給此申請的露營區數量

        if((empty($BN))&&empty($CN)){
            echo "<script>alert('租借數量不可為零')</script>";
            //選擇"是"則跳轉至"查看個人帳號資料頁面"
            //選擇"否"則跳轉回"個人帳號資料修改頁面"
            echo "<script> if(confirm('是否離開租借申請頁面'))  location.href='user.php';else location.href='u_rent_app.php'; </script>";
        }

        $add="INSERT INTO `record` (`record_id`,`state`,`money`,`organization`,`apply_date`,`approved_date`,`pay_date`,`bbq_number`,`camp_number`,`account`) 
        VALUES ('{$lrid}',0,0,'{$ORI}',str_to_date('{$D}','%Y-%m-%d'),NULL,NULL,'{$BN}','{$CN}','{$getName}')";
        mysqli_query($link,$add);//將此申請編號加入record資料表

        //echo "last record id =".$last_rid."<br>";

        #計算申請總金額+分配場地
        $total_cost=0;//總金額
        $find_usr_type="SELECT `type` FROM `user` WHERE `account`='{$getName}'";
        $usr_type=mysqli_fetch_row(mysqli_query($link,$find_usr_type));#透過申請人帳號，獲得申請人的身分別
        $find_usr_out="SELECT `number` FROM `user` WHERE `account`='{$getName}'";
        $usr_out=mysqli_fetch_row(mysqli_query($link,$find_usr_out));#獲得申請人是校內或是校外，若無學校編號，則為校外
        #$CSDT=$_SESSION["CSD"]." ".$_SESSION["CST"].":00";//將date與time合併成符合sql datetime格式的字串
        #$CEDT=$_SESSION["CED"]." ".$_SESSION["CET"].":00";
        #$BSDT=$_SESSION["BSD"]." ".$_SESSION["BST"].":00";//將date與time合併成符合sql datetime格式的字串
        #$BEDT=$_SESSION["BED"]." ".$_SESSION["BET"].":00";

        #https://www.ucamc.com/e-learning/php/300-php-strtotime-%E6%97%A5%E6%9C%9F%E6%99%82%E9%96%93%E7%9B%B8%E5%8A%A0%E7%9B%B8%E6%B8%9B%E8%A8%88%E7%AE%97%E6%99%82%E9%96%93%E5%B7%AE
        $CDiv= ((strtotime($CEDT) - strtotime($CSDT))/ (60*60)); //計算露營區租借了幾個小時
        $BDiv= ((strtotime($BEDT) - strtotime($BSDT))/ (60*60)); //計算烤肉區租借了幾個時段(4小時)
        if($CDiv%24!=0){
            $CDiv=(int)($CDiv/24)+1;
        }
        else{
            $CDiv=(int)($CDiv/24);
        }
        if($BDiv%4!=0){
            $Div=(int)($BDiv/4)+1;
        }
        else{
            $BDiv=(int)($BDiv/4);
        }

        #echo "CDiv= ".$CDiv."<br>";
        #echo "BDiv= ".$BDiv."<br>";

        $distribute="SELECT `place_id` FROM `place` WHERE `type`=1";
        $dis=mysqli_query($link,$distribute);#獲得所有露營區的場地編號
        while($d=mysqli_fetch_row($dis)){//尋訪所有露營區編號
            if($CN==0){
                break;
            }#已分配足夠數量的露營區數量則不需要繼續尋訪
            #echo "one time camp!<br>";
            #echo "CN= ".$CN."<br>";
            #echo "id= ".$d[0]."<br>";
            
            $sql="SELECT COUNT(*) as n 
            FROM `apply` 
            WHERE (`place_id`='{$d[0]}') 
                AND ((str_to_date('{$CSDT}','%Y-%m-%d %h:%i:%s') BETWEEN `time_start` AND `time_finish`) 
                OR (str_to_date('{$CEDT}','%Y-%m-%d %h:%i:%s') BETWEEN `time_start` AND `time_finish`) 
                OR (`time_start` BETWEEN str_to_date('{$CSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$CEDT}','%Y-%m-%d %H:%i:%s')) 
                OR (`time_finish` BETWEEN str_to_date('{$CSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$CEDT}','%Y-%m-%d %H:%i:%s')))";
            $result=mysqli_fetch_assoc(mysqli_query($link,$sql));#確認這個場地在apply資料表裡沒有存在時間重疊的紀錄

            #--------------------新增的部分----------------------------------------------------
            $available_flag = false;//有沒有跟available撞到
            $sql="select * from available where place_id='".$d[0]."'";
            $result_available = mysqli_query($link,$sql);
            while($row=mysqli_fetch_array($result_available)){
                if(strtotime($row[3])>strtotime($CSDT) && strtotime($row[3])<strtotime($CEDT)){
                    $available_flag = true;
                    //echo $d[0];
                    break;
                }
                else if(strtotime($row[2])<strtotime($CEDT) && strtotime($row[2])>strtotime($CSDT)){
                    $available_flag = true;
                    //echo $d[0];
                    break;
                }
                else if(strtotime($row[3])>strtotime($CSDT) && strtotime($row[2])<strtotime($CSDT)){//申請的開始時間夾在已租借內
                    $available_flag = true;
                    break;//任一個疊到就不用繼續判斷了
                    //echo $camp_place[0].'<br>';
                }
                else if(strtotime($row[3])>strtotime($CEDT) && strtotime($row[2])<strtotime($CEDT)){//申請的結束時間夾在已租借內
                    $available_flag = true;
                    break;//任一個疊到就不用繼續判斷了
                    //echo $camp_place[0].'<br>';
                }
            }
            #----------------------------------------------------------------------------------

            //echo "result=".$result['n']."<br>";

            if(empty($result['n']) && $available_flag == false){//不可租借的場地中不包含這一個
                #echo "here is one <br>";
                $addP="INSERT INTO `apply` (`place_id`,`record_id`,`time_start`,`time_finish`) 
                VALUES ('{$d[0]}','{$lrid}',str_to_date('{$CSDT}','%Y-%m-%d %H:%i:%s'),str_to_date('{$CEDT}','%Y-%m-%d %H:%i:%s'))";
                mysqli_query($link,$addP);#更新apply此場地已被租借

                $CN--;

                #在總金額中加入此場地的費用
                if($usr_type[0]==0&&$usr_out[0]==NULL){//一般使用者，無學號/教職員編號=校外人士
                    $sql="SELECT `money_outside` FROM `place` WHERE `place_id`='{$d[0]}'";
                    $money=mysqli_fetch_row(mysqli_query($link,$sql));#此場地的校外租借價格
                    $total_cost=$total_cost+($money[0]*$CDiv);
                }
                else {//校內人士
                    $sql="SELECT `money_school` FROM `place` WHERE `place_id`='{$d[0]}'";
                    $money=mysqli_fetch_row(mysqli_query($link,$sql));#此場地的校內租借價格
                    $total_cost=$total_cost+($money[0]*$CDiv);
                }
            }
        }
        $distribute="SELECT `place_id` FROM `place` WHERE `type`=0";#獲得所有烤肉台的場地編號
        $dis=mysqli_query($link,$distribute);
        while($d=mysqli_fetch_row($dis)){//尋訪所有烤肉台的場地編號
            if($BN==0){
                break;
            }
            
            #echo "one time bbq!<br>";
            #echo "BN= ".$BN."<br>";
            #echo "id= ".$d[0]."<br>";

            $sql="SELECT COUNT(*) as n FROM `apply` WHERE (`place_id`='{$d[0]}') 
            AND ((str_to_date('{$BSDT}','%Y-%m-%d %H:%i:%s') BETWEEN `time_start` AND `time_finish`) 
            OR (str_to_date('{$BEDT}','%Y-%m-%d %H:%i:%s') BETWEEN `time_start` AND `time_finish`) 
            OR (`time_start` BETWEEN str_to_date('{$BSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$BEDT}','%Y-%m-%d %H:%i:%s')) 
            OR (`time_finish` BETWEEN str_to_date('{$BSDT}','%Y-%m-%d %H:%i:%s') AND str_to_date('{$BEDT}','%Y-%m-%d %H:%i:%s')))";
            $result=mysqli_fetch_assoc(mysqli_query($link,$sql));#確認這個場地在apply資料表裡沒有存在時間重疊的紀錄

            $available_flag = false;//有沒有跟available撞到
            $sql="select * from available where place_id='".$d[0]."'";
            $result_available = mysqli_query($link,$sql);
            while($row=mysqli_fetch_array($result_available)){
                if(strtotime($row[3])>strtotime($BSDT) && strtotime($row[3])<strtotime($BEDT)){
                    $available_flag = true;
                    //echo $d[0];
                    break;
                }
                else if(strtotime($row[2])<strtotime($BEDT) && strtotime($row[2])>strtotime($BSDT)){
                    $available_flag = true;
                    //echo $d[0];
                    break;
                }
                else if(strtotime($row[3])>strtotime($BEDT) && strtotime($row[2])<strtotime($BEDT)){//要申請的結束時間夾在已租借的時間內
                    $flag = 0;
                    break;//任一個疊到就不用繼續判斷了
                    //echo $bbq_place[0].'<br>';
                }
                else if(strtotime($row[3])>strtotime($BSDT) && strtotime($row[2])<strtotime($BSDT)){//要申請的開始時間夾在已租借的時間內
                    $flag = 0;
                    break;//任一個疊到就不用繼續判斷了
                    //echo $bbq_place[0].'<br>';
                }
            }

            if(empty($result['n']) && $available_flag == false){//不可租借的場地中不包含這一個，empty(0)=true
                //echo "here is one <br>";
                $addP="INSERT INTO `apply` (`record_id`,`place_id`,`time_start`,`time_finish`) 
                VALUES ('{$lrid}', '{$d[0]}', str_to_date('{$BSDT}','%Y-%m-%d %H:%i:%s') , str_to_date('{$BEDT}','%Y-%m-%d %H:%i:%s'))";
                mysqli_query($link,$addP);#在apply中加入此筆場地
                $BN--;
                #在總金額中加入此場地的費用
                if($usr_type[0]==0&&$usr_out[0]==NULL){//校外人士
                    $sql="SELECT `money_outside` FROM `place` WHERE `place_id`='{$d[0]}'";
                    $money=mysqli_fetch_row(mysqli_query($link,$sql));
                    $total_cost=$total_cost+($money[0]*$BDiv);
                    
                }
                else {//校內人士
                    $sql="SELECT `money_school` FROM `place` WHERE `place_id`='{$d[0]}'";
                    $money=mysqli_fetch_row(mysqli_query($link,$sql));
                    $total_cost=$total_cost+($money[0]*$BDiv);
                }
            }
        }
        //echo "total cost =".$total_cost."<br>";
        //分配完場地，計算出總額

        
        //echo "date =".$D."<br>";
        $get_cost="UPDATE `record` SET `money`='{$total_cost}' WHERE `record_id`='{$lrid}'";
        mysqli_query($link,$get_cost);#補上此筆申請的總金額

        if(isset($_SESSION["CSD"])){
            unset($_SESSION["CSD"]);
        }
        if(isset($_SESSION["CST"])){
            unset($_SESSION["CST"]);
        }
        if(isset($_SESSION["CED"])){
            unset($_SESSION["CED"]);
        }
        if(isset($_SESSION["CET"])){
            unset($_SESSION["CET"]);
        }
        if(isset($_SESSION["CN"])){
            unset($_SESSION["CN"]);
        }
        if(isset($_SESSION["BSD"])){
            unset($_SESSION["BSD"]);
        }
        if(isset($_SESSION["BST"])){
            unset($_SESSION["BST"]);
        }
        if(isset($_SESSION["BED"])){
            unset($_SESSION["BED"]);
        }
        if(isset($_SESSION["BET"])){
            unset($_SESSION["BET"]);
        }
        if(isset($_SESSION["BN"])){
            unset($_SESSION["BN"]);
        }
        if(isset($_SESSION["OR"])){
            unset($_SESSION["OR"]);
        }

        echo "<script type='text/javascript'>";
        echo "window.location.href='u_rent_app_info.php'";
        echo "</script>";
    }
?>

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