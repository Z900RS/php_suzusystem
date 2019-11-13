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
    <title>削除確認画面</title>
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

$list = $pdo->prepare("select * from zaiko where id = $id");
$list->execute();

if($list){
    echo "
        <table>
            <caption>
                <h2>商品データ</h2>
            </caption>
            <tr>
                <th>商品名</th>
                <th>商品説明</th>
                <th>仕入れ先</th>
                <th>生産国</th>
                <th>価格</th>
                <th>仕入れ価格</th>
                <th>在庫数</th>
                <th>入出荷日</th>
            </tr>   
    ";
    while ($data = $list->fetch()){
        echo "
        <tr>
            <td>{$data['item']}</td>
            <td>{$data['i_desc']}</td>
            <td>{$data['i_comp']}</td>
            <td>{$data['country']}</td>
            <td>{$data['price']}</td>
            <td>{$data['w_price']}</td>
            <td>{$data['stock']}</td>
            <td>{$data['day']}</td>          
    ";
    }
}else{
    echo 'エラー';
}
?>
<form action="zaikodelete.php" method="post">
    商品番号：<input type="text" name="id" value="<?php print($id) ?>" readonly="readonly"><br>
    <input type="submit" value="この内容を削除しますか？"><br><br>
</form>
<a href="zaikokakunin.php">在庫確認画面へ</a>

</body>
</html>
