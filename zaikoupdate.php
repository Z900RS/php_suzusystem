<?php
session_start();

if(!isset($_SESSION["NAME"])) {
    $no_login_url = "index_login.php";
    header("Location: {$no_login_url}");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新画面</title>
    <meta charset="utf8">
</head>
<link href="../css/zaiko.css" rel="stylesheet">
<body>
<?php
$pdo = new PDO("mysql:dbname=zaiko;host=localhost;charset=utf8mb4",
"root",
"");

if($pdo){
//    echo '成功';
}else{
echo '失敗';
}
//POSTで受け取った値を変数に格納
$id = $_POST['id'];
$item = $_POST["item"];
$i_desc = $_POST["i_desc"];
$i_comp = $_POST["i_comp"];
$country = $_POST["country"];
$price = $_POST["price"];
$w_price = $_POST["w_price"];
$stock = $_POST["stock"];
$day = date($_POST['day']);

//アップデートセット
$list = $pdo->prepare("UPDATE zaiko SET item='$item',i_desc='$i_desc',i_comp='$i_comp',country='$country',price=$price,w_price=$w_price,stock=$stock,day='$day' where id = $id");
//アップデート実行
$list->execute();

if($list and $id){
    echo '成功';
    echo '※更新しました。';
//    var_dump($list);
}else{
    echo '失敗';
}
?>


<br><a href="zaikokakunin.php">在庫確認画面へ</a>
</body>
</html>



