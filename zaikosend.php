<!DOCTYPE html>
<html>
<head>
    <title>商品</title>
    <meta charset="utf-8">
</head>
<link href="../css/zaiko.css" rel="stylesheet">
<body>
<?php
//    POSTにデータがある場合
    if(isset($_POST["item"],$_POST["i_desc"],$_POST["i_comp"],$_POST["country"]
    ,$_POST["price"],$_POST["w_price"],$_POST["stock"],$_POST["day"])) {
//    変数に代入
        $item = $_POST["item"];
        $i_desc = $_POST["i_desc"];
        $i_comp = $_POST["i_comp"];
        $country = $_POST["country"];
        $price = $_POST["price"];
        $w_price = $_POST["w_price"];
        $stock = $_POST["stock"];
        $day = date("Y-m-d");
    }
//    DBに接続
$pdo = new PDO(
    "mysql:dbname=zaiko;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'")
);
//    DB接続確認
if($pdo){
//    echo 'DB接続成功';
}else{
    echo 'DB接続失敗';
}
//    DBの項目に入れる準備
$regist = $pdo->prepare("INSERT INTO zaiko(item, i_desc, i_comp, country, price, w_price, stock, day) VALUES (?,?,?,?,?,?,?,?)");

//    定義した内容を格納
$regist->bindParam("item",$item);
$regist->bindParam("i_desc",$i_desc);
$regist->bindParam("i_comp",$i_desc);
$regist->bindParam("country",$country);
$regist->bindParam("price",$price);
$regist->bindParam("w_price",$w_price);
$regist->bindParam("stock",$stock);
$regist->bindParam("day",$day);

$regist->execute(array($item,$i_desc,$i_comp,$country,$price,$w_price,$stock,$day));

if($regist){
    echo '登録完了';
}else{
    echo 'エラー';
}
?>
<br><br><a href="zaikoform.php">登録画面へ</a>

</body>
</html>



