<?php
$user = $_COOKIE['user'];
$id = $_GET['id'];
$datetime = $_GET['time'];
$Quantity = $_GET['q'];

$link = mysqli_connect("localhost","root",
"12345678","project")
or die("無法開啟MySQL資料庫連接!<br/>");

$sql = "DELETE FROM `book` WHERE `datetime` = '".$datetime."' AND id = '".$id."' AND user = '".$user."'" ;
echo $sql."\n";
$res = mysqli_query($link,$sql);
$sql = "UPDATE `shop` SET `Quantity`=`Quantity`-".$Quantity." WHERE `id` = '".$id."'" ;
echo $sql."\n";
$res = mysqli_query($link,$sql);
mysqli_close($link);
header("Location: shopcart.php?");  // 轉址
?>