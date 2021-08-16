<!--接收使用者送出的資料-->
<?php
    include("../connect.php");//連接到資料庫
   
    session_start();//啟用session
    if(isset($_SESSION['account'])){
        $getName=$_SESSION['account'];
        //再從資料庫中取出帳號資料，用以確認使用者是否更改密碼欄位
        $sql_query="select * from user where account='".$getName."'";
        $result=mysqli_query($link,$sql_query);
        $row=mysqli_fetch_array($result);

        $name=$_POST["usr_name"];//姓名
        $tel=$_POST["usr_tel"];//電話
        $email=$_POST["usr_email"];//電子郵件

        $mod="UPDATE user SET `name`='{$name}', `tel`='{$tel}', `mail`='{$email}' WHERE `account`='{$getName}'";
        //
        $result= mysqli_query($link,$mod);
        if($result){
            echo "<script>alert('修改資料成功')</script>";
            //選擇"是"則跳轉至"查看個人帳號資料頁面"
            //選擇"否"則跳轉回"個人帳號資料修改頁面"
            echo "<script> if(confirm('是否為您跳轉到查看個人資料頁面'))  location.href='u_view_acc.php';else location.href='u_mod_acc.php'; </script>";
        }
    }
?>