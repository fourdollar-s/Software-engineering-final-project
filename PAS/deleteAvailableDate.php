<?php
    include("../connect.php");
    //接收前端輸入資料 
    if (isset($_POST["sub"])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM `available` WHERE `id` = " .$id;
        if ($sql_qry->exec($sql)) {
            echo "<script> alert('修改成功'); </script>";
            header("location: p_del_rule.php");
         } 
        else {
            echo "<script> alert('修改失敗'); history.back(); </script>";
        }
    }
?>