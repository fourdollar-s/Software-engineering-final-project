<?php
    include("../connect.php");
    //接收前端輸入資料 
    if (isset($_POST["sub"])) {
        $verification = $_POST['verification'];
        session_start();
        $id = $_SESSION['id'];
        if($verification == 'yes'){
            date_default_timezone_set('Asia/Taipei');
            $today = date('Y-m-d');
            $sql = "UPDATE `record` SET `approved_date` = '" . $today . "', `state` = 1 WHERE `record_id`='" . $id . "'";
            if ($sql_qry->exec($sql)) {
                echo "<script> alert('修改成功'); </script>";
                header("location: p_app_verify.php");;
            } 
            else {
                echo "<script> alert('修改失敗'); history.back(); </script>";
            }
        }
        else {
            $sql = "UPDATE `record` SET `state` = 3 WHERE `record_id`='" . $id . "'";
            if ($sql_qry->exec($sql)) {
                echo "<script> alert('修改成功'); </script>";
                header("location: p_app_verify.php");
            } 
            else {
                echo "<script> alert('修改失敗'); history.back(); </script>";
            }
        }
        
    }
    
?>