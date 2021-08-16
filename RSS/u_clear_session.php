<?php
session_start();
if(isset($_SESSION["CSD"])){
    unset($_SESSION["CSD"]);
}
if(isset($_SESSION["CST"])){
    unset($_SESSION["CST"]);
}
if(isset($_SESSION["CED"])){
    unset($_SESSION["CED"]);
}
if(isset($_SESSION["CET"])){
    unset($_SESSION["CET"]);
}
if(isset($_SESSION["CN"])){
    unset($_SESSION["CN"]);
}
if(isset($_SESSION["BSD"])){
    unset($_SESSION["BSD"]);
}
if(isset($_SESSION["BST"])){
    unset($_SESSION["BST"]);
}
if(isset($_SESSION["BED"])){
    unset($_SESSION["BED"]);
}
if(isset($_SESSION["BET"])){
    unset($_SESSION["BET"]);
}
if(isset($_SESSION["BN"])){
    unset($_SESSION["BN"]);
}
if(isset($_SESSION["OR"])){
    unset($_SESSION["OR"]);

echo "<script type='text/javascript'>";
echo "window.location.href='u_rent_app.php'";
echo "</script>";
}
?>