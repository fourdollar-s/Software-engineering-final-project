<?php 
include("../connect.php");
$sql = "SELECT count(*) FROM `record` WHERE `state` = 2";
$result = $sql_qry->query($sql);
$row1 = $result->fetch(PDO::FETCH_NUM);

if($row1[0] >= 5){
    $sql = "SELECT * FROM `record` WHERE `state` = 2 ORDER BY `apply_date`,`approved_date`";
    $result = $sql_qry->query($sql);

    while($row=$result->fetch(PDO::FETCH_NUM)){
        $myfile = fopen("record_file.txt", "a+"); 
        $bytes = fwrite($myfile, "申請日期:$row[4]\r\n通過審核日期:$row[5]\r\n繳費日期:$row[6]\r\n申請人帳號:$row[9]\r\n申請紀錄編號:$row[0]\r\n申請烤肉爐數量:$row[7]\r\n申請露營區數量:$row[8]\r\n申請人所屬組織:$row[3]\r\n申請總額:$row[2]\r\n\r\n"); 
        fclose($myfile); 
    }

    $sql = "DELETE FROM `record` WHERE `state` = 2";
    //$sql_qry->exec($sql);
    echo "<script> alert('歸檔成功');history.back();</script>";
}
else
    echo "<script> alert('紀錄數量小於5筆，尚未需要歸檔');history.back();</script>";
?>