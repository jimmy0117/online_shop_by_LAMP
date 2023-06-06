<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>shop.php</title>
<?php
//error_reporting(0);
$link = mysqli_connect("localhost","root",
"12345678","project")
or die("無法開啟MySQL資料庫連接!<br/>");
// 設定報告等級
error_reporting(E_ERROR | E_WARNING);
?>
</head>
<body bgcolor="#FFCD38" text="#541690">
<center><table border="0">
<tr bgcolor="#F9FFA4">
   <td>編號</td><td>餐點</td>
   <td>價格</td><td>開單者</td>
   <td>最大數量</td>
   <td>數量</td><td>詳細內容</td>
</tr>
<?php
// 插入函式庫的PHP檔案
require_once("dataAccess.php");
// 建立dataAccess物件的資料庫連接
$dao = new dataAccess("localhost","root",
                      "12345678","project");
$sql = "SELECT * FROM shop WHERE `user` = '".$_COOKIE["user"]."' ORDER BY `id`";  // 建立SQL指令字串
$dao->fetchDB($sql);  // 執行SQL查詢指令字串
$flag = false;
// 顯示資料庫內容
while ( $row = $dao->getRecord() ) {
   if ($flag) {
      $flag = false;
      $color="#FF4949";
   } else {
      $flag = true;
      $color="#FF8D29";
   }
   // 顯示選購商品的表單
   ?>
   <form action="shop.php" method="post">
      <tr bgcolor="<?php echo $color ?>">
   <td><?php echo $row["id"] ?></td>
   <td><?php echo $row["name"] ?></td>
   <td><?php echo $row["price"] ?></td>
   <td><?php echo $row["user"] ?></td>
   <td><?php echo $row["MaxQuantity"] ?></td>
   <td><?php echo $row["Quantity"] ?></td>
   </td><td valign="top">
      <input type="button" value = 詳細內容 name=<?php echo $row["id"] ?> onclick="location.href='orderinfo.php?id=' + name ;">
   </td>
</tr>
</form>
<?php
}
?>
</table>
<hr/>| <a href="shop.php">網路商店</a>
| <a href="neworder.html?">我要開單</a>
| <a href="shopcart.php?">查看購物車</a>
| <a href="myorder.php">開單紀錄</a> |
</center>
<?php
echo "現在使用者：".$_COOKIE["user"];
?><br>
<input type="button" value="登出" onclick="location.href='login.php'">
</body>
</html>
