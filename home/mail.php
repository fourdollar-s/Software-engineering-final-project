<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["sub"])){
    include("../connect.php");
    $account = $_POST["account"];
    $email = $_POST["mail"];

    $sql = "SELECT `account`,`mail`,`name`,`password` FROM `user` WHERE `account`='".$account."'";
    $result = $sql_qry->query($sql);
    $row = $result->fetch(PDO::FETCH_NUM);
    if(!$row){
        echo "<script> alert('查無此帳號');history.back();</script>";
        exit();
    }
    elseif($row[1] != $email){
        echo "<script> alert('此信箱非註冊信箱');history.back();</script>";
        exit();
    }
    else{
        $name = $row[2];
        $password = $row[3];

    }
}
else{
    header("Location: passwd_forgot.php");
    exit();
}
//Load Composer's autoloader
require '../vendor/autoload.php';
//建立物件 
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
    $mail->SMTPDebug = 0; // DEBUG訊息
    $mail->isSMTP(); // 使用SMTP
    $mail->Host = 'smtp.gmail.com'; // SMTP server 位址
    $mail->SMTPAuth = true;  // 開啟SMTP驗證
    $mail->Username = 'a1075542@mail.nuk.edu.tw'; // SMTP 帳號
    $mail->Password = 'rwcfunwbmuuitguq'; // SMTP 密碼
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->SMTPSecure = "ssl"; // Gmail要透過SSL連線
    $mail->Port       = 465; // SMTP TCP port 

    //設定收件人資料
    $mail->setFrom('a1075542@mail.nuk.edu.tw', 'CBRS_ADMIN'); // 寄件人(透過Gmail發送會顯示Gmail帳號為寄件者)
    $mail->addAddress( $email , $name); // 收件人會顯示 Apple User<apple@example.com>(*註2)
    // $mail->addAddress('banana@example.com'); // 名字非必填
    //$mail->addReplyTo('a1075542@mail.nuk.edu.tw', 'CBRS_ADMIN'); //回信的收件人
    //$mail->addCC('cc@example.com'); //副本
    //$mail->addBCC('bcc@example.com'); //密件副本
    //$mail->CharSet = 'UTF-8';
    // 附件
    //$mail->addAttachment('/var/tmp/file.tar.gz'); // 附件 (*註3) 
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // 插入附件可更改檔名

    // 信件內容
    $mail->isHTML(true); // 設定為HTML格式
    $mail->Subject = 'CBRS forgot password'; // 信件標題
    $mail->Body    = "hello! $name <br> your password is $password"; // 信件內容
    //$mail->AltBody = 'hello! eric \nyour password is'; // 對方若不支援HTML的信件內容

    $mail->send();
    echo "<script> alert('密碼已送至您的信箱');history.back();</script>";
    exit();
} catch (Exception $e) {
    echo "<script> alert('寄送失敗，請重新寄送');history.back();</script>";
}
?>