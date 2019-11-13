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
    <title>更新設定画面</title>
    <meta charset="utf8">
</head>
<link href="../css/zaiko.css" rel="stylesheet">
<body class="update">
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
//入力された商品番号の値を取得する
$list = $pdo->prepare("select * FROM zaiko WHERE id = $id");
$list->execute();
$data = $list->fetch();

?>

<form action="zaikoupdate.php" method="post">
<table>
    <tr>
        <th>商品番号</th>
        <td><input type="text" name="id" value="<?php print($data['id']); ?>"  readonly="readonly" >※入力不可</td>
    </tr>
    <tr>
        <th>商品名</th>
        <td><input type="text" name="item" value="<?php print($data['item']); ?>"></td>
    </tr>
    <tr>
        <th>商品説明</th>
        <td><textarea name="i_desc" id="" cols="30" rows="10" maxlength="30"><?php print($data['i_desc'])?></textarea> </td>
    </tr>
    <tr>
        <th>仕入れ先</th>
        <td><input type="text" name="i_comp" value="<?php print($data['i_comp']); ?>"></td>
    </tr>
    <tr>
        <th>生産国</th>
        <td><input type="text" name="country" value="<?php print($data['country']); ?>"></td>
    </tr>
    <tr>
        <th>価格</th>
        <td><input type="text" name="price" value="<?php print($data['price']); ?>"></td>
    </tr>
    <tr>
        <th>仕入れ価格</th>
        <td><input type="text" name="w_price" value="<?php print($data['w_price']); ?>"></td>
    </tr>
    <tr>
        <th>在庫数</th>
        <td><input type="text" name="stock" value="<?php print($data['stock']); ?>"></td>
    </tr>
    <tr>
        <th>入荷日</th>
        <td><input type="date" name="day" value="<?php print($data['day']); ?>"></td>
    </tr>
</table>
    <input type="submit" value="この内容で変更しますか？">
</form>

<a href="zaikokakunin.php">在庫確認画面へ</a>
</body>
</html>
