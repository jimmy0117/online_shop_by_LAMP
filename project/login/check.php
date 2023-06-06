<?php
$date = $_GET['time'];
$id = $_GET['id'];
$link = mysqli_connect("localhost","root",
"12345678","project")
or die("無法開啟MySQL資料庫連接!<br/>");
$sql = "UPDATE `book` SET `pay`='1' WHERE `datetime` = '".$date."'" ;
echo $sql;
$res = mysqli_query($link,$sql);
mysqli_close($link);
header("Location: orderinfo.php?"."id=".$id);  // 轉址
?>