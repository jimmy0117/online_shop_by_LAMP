<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>creat.php</title>
</head>
<body>
<?php
session_start();  // 啟用交談期
$sno = "";  $user = "";  $username = "";  $password = "";
// 取得表單欄位值
if ( isset($_POST["Sno"]) )
   $sno = $_POST["Sno"];
if ( isset($_POST["User"]) )
   $user = $_POST["User"];
if ( isset($_POST["Username"]) )
   $username = $_POST["Username"];
if ( isset($_POST["Password"]) )
   $password = $_POST["Password"];
// 檢查是否輸入使用者名稱和密碼
if ($sno != "" && $user != "" && $username != "" && $password != "") {
   // 建立MySQL的資料庫連接 
   $link = mysqli_connect("localhost","root",
                          "12345678","project")
        or die("無法開啟MySQL資料庫連接!<br/>");
   // 建立SQL指令字串
   $password = hash('sha256',$password);
   $sql = "INSERT INTO `user` (`sno`, `name`, `id`, `password`) VALUES ('".$sno."', '".$user."', '".$username."', '".$password."');";
   // 執行SQL查詢
   //echo $sql;
   try {
      $result = mysqli_query($link, $sql);
      echo "<script> {window.alert('建立成功');location.href='login.php'} </script>";
   } catch (\Throwable $th) {
      echo "<script> {window.alert('建立失敗');location.href='creat.php'} </script>";
   }
   mysqli_close($link);  // 關閉資料庫連接  
}
?>
<form action="creat.php" method="post">
<table align="center" bgcolor="#FFCC99">
 <tr><td><font size="2">id:</font></td>
   <td><input type="text" name="Sno" 
             size="15" maxlength="10"/>
   </td></tr>
 <tr><td><font size="2">使用者名稱:</font></td>
   <td><input type="text" name="User"
              size="15" maxlength="10"/>
   </td></tr>
   <tr><td><font size="2">帳號:</font></td>
   <td><input type="text" name="Username" 
             size="15" maxlength="10"/>
   </td></tr>
 <tr><td><font size="2">密碼:</font></td>
   <td><input type="password" name="Password"
              size="15" maxlength="10"/>
 <tr><td colspan="2" align="center">
   <input type="submit" value="建立帳號"/>
   </td></tr> 
</table>
</form>
</body>
</html>