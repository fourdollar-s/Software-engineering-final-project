<html>
<head>
    <title>測試下載pdf</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script  src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script type="text/javascript">    
    function screenshot(){
        var doc = new jsPDF();
                html2canvas(document.getElementById('print')).then(function(canvas) {
                    document.body.appendChild(canvas);
                        var a= canvas.toDataURL("image/jpeg");
                        doc.addImage(a, 'JPEG', 0, 0, canvas.width/5, canvas.height/5);
                        doc.save('usr_info.pdf');
                        location.reload();
                        //a.click();
                });

    }
    </script>
    <input type="button" value="下載" onclick="screenshot()">
<?php
    include("../connect.php");


    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    # 取得日期與時間（新時區）
    $time_now = date('Y/m/d');
    $time_array = explode("/",$time_now);
    $time_taiwan = $time_array[0]-1911;
    $time = "中華民國".$time_taiwan."年".$time_array[1]."月".$time_array[2]."日(".$time_array[1].".".$time_array[2].".".$time_array[0].")";

    $id = $_POST["id"];
    $money = $_POST["money"];
    $name = $_POST["name"];

    $sql_query="select * from user where account = '".$name."'";
	$result=mysqli_query($link,$sql_query);
    $row=mysqli_fetch_array($result)
?>

    <div id="print">
        <img src="../pic/nuk.jpg" style="margin: 0px 50px 0px 180px;">高大收入字第 <?php echo $id;?> 號 <br>
        <br><p style="margin: 0px 0px 0px 300px;">自行收納款項統一收據</p>
        <p style="margin: 0px 0px 0px 250px;"><?php echo $time;?></p>
        <table border = 1 width = 800px height = 200px>
            <tr>
            <td>繳款人<br>PAID BY</td>
            <td>收入科目及代號<br>REVENUS ACCOUNT</td>
            <td>金額<br>AMOUNT</td>
            <td>事由<br>PURPOSE</td>
            </tr>
            
            <tr height = 150px>
            <td>國立高雄大學<?php echo $row[2]; ?></td>
            <td></td>
            <td> <?php echo 'NT$'.$money; ?> </td>
            <td>租借露營區/烤肉區</td>
            </tr>
    
            <tr>
            <td>金額</td>
            <td colspan="3">新台幣 <?php echo $money; ?> 元整
            </tr>
        </table>
    
        <table width = 800px>
            <tr>
                <td>經手人<br>WALLA</td>
                <td>主辦出納<br>CHIEF CASHIER</td>
                <td>主辦會計<br>CHIEF<br>ACCOUNTANT</td>
                <td>機關長官<br>PRESIDENT</td>
            </tr>
        </table>
        <p>
        本收據未經經手人蓋章無效<br>第一聯:收執聯(繳款人收執)<br>
        -------------------------------------------------------------------------------------------------------------------------------------------------------
        </p>
        <table border = 1 width = 800px height = 200px>
            <tr>
            <td>繳款人<br>PAID BY</td>
            <td>收入科目及代號<br>REVENUS ACCOUNT</td>
            <td>金額<br>AMOUNT</td>
            <td>事由<br>PURPOSE</td>
            </tr>
            
            <tr height = 150px>
            <td>國立高雄大學<?php echo $name; ?></td>
            <td></td>
            <td> <?php echo 'NT$'.$money; ?> </td>
            <td>租借露營區/烤肉區</td>
            </tr>
    
            <tr>
            <td>金額</td>
            <td colspan="3">新台幣 <?php echo $money; ?> 元整
            </tr>
        </table>
    
        <table width = 800px>
            <tr>
                <td>經手人<br>WALLA</td>
                <td>主辦出納<br>CHIEF CASHIER</td>
                <td>主辦會計<br>CHIEF<br>ACCOUNTANT</td>
                <td>機關長官<br>PRESIDENT</td>
            </tr>
        </table>
        <p>
        本收據未經經手人蓋章無效<br>第二聯:收執聯(收款人收執)<br>
        </p>
    </div>
</body>
</html>