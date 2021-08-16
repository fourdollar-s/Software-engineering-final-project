<?php
$db_server = 'localhost'; //伺服器(不用改)
$db_name = 'se'; //資料庫(存放table的資料庫名稱)
$db_user = 'ilok'; //使用者
$db_passwd = 'sj152294'; //密碼
$sql = 'mysql:host=' . $db_server . ';dbname=' . $db_name;
try {
    $sql_qry = new PDO($sql, $db_user, $db_passwd);
    $link=mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
    //if ($sql_qry) echo "資料庫連線成功";
} catch (PDOException $e) {
    die("資料庫連線失敗");
}
?>