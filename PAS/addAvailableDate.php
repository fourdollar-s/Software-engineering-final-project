<?php
    include("../connect.php");
    //接收前端輸入資料 
    if (isset($_POST["sub"])) {
        $place_id = $_POST['id'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $sql = "SELECT * FROM `available`";
        $result = $sql_qry->query($sql);
        $temp = 0;
        while($row1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $temp = $row1['id'];
        }
        $id = $temp + 1;
        echo "<script> alert('".$id."'); </script>";
        $sql = "SELECT * FROM `place` WHERE `place_id` =" .$place_id;
        $result = $sql_qry->query($sql);
        $row1 = $result->fetch(PDO::FETCH_ASSOC);
        $type = $row1['type'];
        echo "<script> alert('".$type."'); </script>";
        $sql = "INSERT INTO `available`(`id`, `type`, `time_start`, `time_end`, `place_id`) VALUE(" .$id. "," .$type. ",'" .$time_start. " 00:00:00','" .$time_end. " 23:59:59'," .$place_id. ")";
        if ($sql_qry->exec($sql)) {
            echo "<script> alert('修改成功'); </script>";
            header("location: p_add_rule.php");
         } 
        else {
            echo "<script> alert('修改失敗'); history.back(); </script>";
        }
    }
    
?>