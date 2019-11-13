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
    <title>削除画面</title>
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

if(isset($_POST["id"])){
    $id = $_POST["id"];
}
//在庫テーブルにて入力された商品番号を削除する
$list = $pdo->prepare("DELETE FROM zaiko WHERE id = $id");
//削除する商品番号を取り出す
$list->execute();

if($list){
    echo '削除しました。';
}else{
    echo '削除できませんでした。';
}

?>
<!--<p>※削除しました。</p>-->

<a href="zaikokakunin.php">在庫確認画面へ</a>
</body>
</html>



