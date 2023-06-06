<?php
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
    <body bgcolor="#FFCC77" text="blue">
    商品編號:<?php echo $id;?>
    商品名稱:<?php echo $row["name"];?><p>
    商品價格:<?php echo $row["price"];?><p>
    商品最大數量:<?php echo $row["MaxQuantity"];?><p>
    商品可訂數量:<?php echo $row["MaxQuantity"]-$row["Quantity"];?><p>
    <?php  setcookie("id", $id , time()+14400);?>
    <?php if($row["MaxQuantity"]-$row["Quantity"]<=0){
            header("Location: shop.php");
            }
    ?>
    <form id = 'form'>
        訂購數量:<input id = "Q"></input><p>
    </form>
    <input type="button" value="送出" onclick="location.href='newbook_sql.php?'+AddData();">
    <script>
        function AddData() {
            const formElement = document.getElementById("form");
            const Q = formElement[0].value;
            return 'Q='+Q;
        }function GetQ() {
            const formElement = document.getElementById("form");
            const Q = formElement[0].value;
            return Q;
        }
    </script>
<html>
<?php
mysqli_close($link);
?>