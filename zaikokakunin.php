<form action="index_logout.php" method="post">
    <input type="submit" value="ログアウト">
</form>
<?php
session_start();

if(!isset($_SESSION["NAME"])) {
    $no_login_url = "index_login.php";
    header("Location: {$no_login_url}");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>在庫テーブル</title>
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
//在庫テーブルの値を全検索する
$list = $pdo->prepare("select * FROM zaiko");

//検索した値を取り出す
$list->execute();
//在庫テーブルに値がある場合
if($list){
    echo "
        <table>
            <caption>
                <h2>商品データ</h2>
            </caption>
            //商品テーブル_ヘッダー部分
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th class='th1'>商品説明</th>
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
            <td>{$data['id']}</td>
            <td>{$data['item']}</td>
            <td>{$data['i_desc']}</td>
            <td>{$data['i_comp']}</td>
            <td>{$data['country']}</td>
            <td>{$data['price']}</td>
            <td>{$data['w_price']}</td>
            <td>{$data['stock']}</td>
            <td>{$data['day']}</td>          
         </tr>   
    ";
}
}else{
    echo "エラー";
}
echo  "</table>";
?>
<br><br><a href="zaikoform.php">登録画面へ</a>

<br><h2>※削除↓</h2>
<form action="zaikodelete2.php" method="post">
    商品番号：<input type="text" name="id" required>
    <input type="submit" value="削除">
</form>

<br><h2>※更新↓</h2>
<form action="zaikoupdate2.php" method="post">
    商品番号：<input type="text" name="id" required>
    <input type="submit" value="更新">
</form>

<br><h2>※ファイルダウンロード↓</h2>
<form action="zaikodow.php" method="post">
    <input type="submit" value="Download">
</form>

<br><h2>※ファイルアップロード↓</h2>
<form action="zaikoupload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="upfile" size="30"><br>
    <input type="submit" value="Upload">
</form>
</body>
</html>



