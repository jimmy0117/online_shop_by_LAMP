<?php
$Quantity = $_GET['Q'];
$id = $_COOKIE["id"];
setcookie("id","",time()-3600);
$link = mysqli_connect("localhost","root",
"12345678","project")
or die("無法開啟MySQL資料庫連接!<br/>");
$sql = "SELECT * FROM `shop` WHERE `id` = ".$id ;
echo $sql;
$res = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($res);
$sql = "UPDATE `shop` SET `Quantity`=". $Quantity+$row["Quantity"] .". WHERE `id` = ".$id;
echo $sql;
mysqli_query($link,$sql);
$sql = "INSERT INTO `book`(`user`, `id`, `quantity`, `datetime`) VALUES ('".$_COOKIE['user']."','".$id."','".$Quantity."','".date("Y-m-d H:i:s")."')";
echo $sql;
mysqli_query($link,$sql);
mysqli_close($link);
header("Location: shop.php");  // 轉址
?>