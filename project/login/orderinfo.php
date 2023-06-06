<?php
function reboolean($s){
   if (intval($s)==0){
      return "否";
   }return "是";
}
$id = $_GET['id'];
$link = mysqli_connect("localhost","root",
"12345678","project")
or die("無法開啟MySQL資料庫連接!<br/>");
$sql = "SELECT * FROM `shop` WHERE `id` = ".$id ;
//echo $sql;
$res = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($res);
?>
<html>
    商品編號:<?php echo $id;?>
    商品名稱:<?php echo $row["name"];?><p>
    商品價格:<?php echo $row["price"];?><p>
    商品最大數量:<?php echo $row["MaxQuantity"];?><p>
    商品可訂數量:<?php echo $row["MaxQuantity"]-$row["Quantity"];?><p>
    <body bgcolor="#FFCD38" text="#541690">
<center><table border="0">
<tr bgcolor="#F9FFA4">
   <td>訂購者</td><td>數量</td>
   <td>訂購時間</td>
   <td>是否付款</td>
   <td>改為付款</td>
</tr>
<?php
// 插入函式庫的PHP檔案
require_once("dataAccess.php");
// 建立dataAccess物件的資料庫連接
$dao = new dataAccess("localhost","root",
                      "12345678","project");
$sql = "SELECT * FROM book WHERE `id` = '".$id."'";  // 建立SQL指令字串
//echo $sql;
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
   <td><?php echo $row["user"] ?></td>
   <td><?php echo $row["quantity"] ?></td>
   <td><?php echo $row["datetime"] ?></td>
   <td><?php echo reboolean($row["pay"]) ?></td>
   <?php
      if($row["pay"]==false){
   ?>
   </td><td valign="top">
   <input type="button" value = 改為付款 onclick='location.href="check.php?time=<?php echo $row["datetime"] ."&id=". $id; ?>"'>
   </td>
   <?php 
   }
   ?>
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
<?php
mysqli_close($link);
?>