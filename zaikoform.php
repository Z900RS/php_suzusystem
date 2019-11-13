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
    <title>商品</title>
    <meta charset="utf-8">
</head>
<link href="../css/zaiko.css" rel="stylesheet">
<body>
<h1>商品登録画面</h1>
    <form action="zaikosend.php" method="post">
        <table>
            <tr>
                <th>商品名</th>
                <td><input type="text" name="item" required></td>
            </tr>
            <tr>
                <th>商品説明</th>
                <td><textarea name="i_desc" id="" cols="30" rows="10" maxlength="30"></textarea></td>
            </tr>
            <tr>
                <th>仕入れ先</th>
                <td><input type="text" name="i_comp"></td>
            </tr>
            <tr>
                <th>生産国</th>
                <td><input type="text" name="country"></td>
            </tr>
            <tr>
                <th>価格</th>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <th>仕入れ価格</th>
                <td><input type="text" name="w_price"></td>
            </tr>
            <tr>
                <th>在庫数</th>
                <td><input type="text" name="stock"></td>
            </tr>
            <tr>
                <th>入荷日</th>
                <td><input type="date" name="day"></td>
            </tr>
            <tr colspan="2">
                <td><input type="submit" value="送信"></td>
            </tr>
        </table>
    </form>

<br><br><a href="zaikokakunin.php">商品データベース確認</a>

</body>
</html>



