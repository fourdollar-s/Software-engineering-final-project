<div class="title">
    <p>公告</p>
    </div>
    <div class="announce">
        <div class="announce">
        <table border=1 width="100%">
            <tr>
                <td width="15%">發布人</td>
                <td width="35%">發布日期</td>
                <td width="50%">標題</td>
            </tr>
            
            <?php
                include("../connect.php");
                $sql = "SELECT `id`,`type`,`time`,`title` FROM `announcement`,`user` WHERE `announcer`=`account` ORDER BY `time` DESC";
                $result = $sql_qry->query($sql);
                $announcer;
                while($row1 = $result->fetch(PDO::FETCH_NUM)){
                    if($row1[1]==1){
                        $announcer = "系統管理員";
                    }
                    elseif($row1[1]==2){
                        $announcer = "出納人員";
                    }
                    elseif($row1[1]==3){
                        $announcer = "場地管理員";
                    }
                    echo '
                    <tr>
                        <td>'.$announcer.'</td>
                        <td>'.$row1[2].'</td>
                        <td><a href="announce.php?id='.$row1[0].'">'.$row1[3].'</td>
                    </tr>
                    ';
                }
            ?>
        </table>
        </div>
    </div>