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
   <td>數量</td><td>刪除</td>
</tr>
<?php
// 插入函式庫的PHP檔案
require_once("dataAccess.php");
// 建立dataAccess物件的資料庫連接

$dao = new dataAccess("localhost","root",
                      "12345678","project");
$sql = "SELECT * FROM book WHERE `user` = '".$_COOKIE["user"]."';";  // 建立SQL指令字串
$dao->fetchDB($sql);  // 執行SQL查詢指令字串
$flag = false;
function findName($id){
   $link = mysqli_connect("localhost","root",
"12345678","project")
or die("無法開啟MySQL資料庫連接!<br/>");
   $sql = "SELECT `name` FROM `shop` WHERE `id` = ". $id .";";
   $result = mysqli_query($link,$sql);  // 執行SQL查詢指令字串
   $row = mysqli_fetch_assoc($result);
   return $row['name'];
}
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
   <td><?php echo findName($row["id"]) ?></td>
   <td><?php echo $row["quantity"] ?></td>
   <td valign="top">
      <input type="button" value = 刪除 name=<?php echo $row["id"] ?> onclick='location.href="delet.php?time=<?php echo $row["datetime"]."&id=".$row["id"]."&q=".$row["quantity"] ?>"'>
   </td>
</tr>
</form>
<?php
}
?>
<a href='shop.php'>返回</a>