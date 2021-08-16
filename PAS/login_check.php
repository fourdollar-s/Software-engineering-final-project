<?php
	include("../connect.php");
	session_start();
	if(!isset($_SESSION['account']) || !isset( $_SESSION['password'])){
		echo "<script> alert('請由正當管道進入');</script>";
		echo "<script> document.location.href='../logout.php';</script>";
	}

	$account = $_SESSION['account'];
	$password = $_SESSION['password'];
	$sql = "SELECT `name` FROM `user` WHERE `account`= '".$account."' AND  `password` = '".$password."' AND type=1";
	$result = $sql_qry->query($sql);
	$row = $result->fetch(PDO::FETCH_NUM);

echo "
<script>
function logout() {
    var yes = confirm('確定登出嗎？');
	if(yes){
		alert('已登出') ;
		document.location.href='../logout.php';
	}
}
function jumphome() {
    var yes = confirm('若回到首頁會登出喔');
	if(yes){
		alert('已登出') ;
		document.location.href='../logout.php';
	}
}

</script>


";



?>