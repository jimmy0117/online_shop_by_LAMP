<?php
$id = date("mdHis");
$name = $_GET['name'];
$price = $_GET['price'];
$MaxQ = $_GET['MaxQ'];
$Q = $_GET['Q'];
$user = $_COOKIE['user'];
$link = mysqli_connect("localhost","root",
"12345678","project")
or die("無法開啟MySQL資料庫連接!<br/>");
$sql = "INSERT INTO `shop`(`id`, `name`, `price`, `user`, `StartTime`, `EndTime`, `MaxQuantity`, `Quantity`, `PayTime`) VALUES ('".$id."','".$name."','".$price."','".$user."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s",strtotime("4 hours"))."','".$MaxQ."','".$Q."','".date("Y-m-d H:i:s",strtotime("2 hours"))."');";
echo $sql;
mysqli_query($link,$sql);
$sql = "INSERT INTO `book`(`user`, `id`, `quantity`, `datetime`) VALUES ('".$user."','".$id."','".$Q."','".date("Y-m-d H:i:s")."')";
echo $sql;
mysqli_query($link,$sql);
mysqli_close($link);
header("Location: shop.php");  // 轉址
?>