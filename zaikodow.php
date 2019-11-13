<?php
session_start();

if(!isset($_SESSION["NAME"])) {
    $no_login_url = "index_login.php";
    header("Location: {$no_login_url}");
    exit;
}
?>

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
$sql = "SELECT * FROM zaiko ";
$down = $pdo->prepare($sql);
$down->execute();


//CSV文字列生成
$csvstr = "";
while ($row = $down->fetch(PDO::FETCH_ASSOC)) {
    $csvstr .= $row['id'] . ",";            //商品番号
    $csvstr .= $row['item'] . ",";          //商品名
    $csvstr .= $row['i_desc'] . ",";        //商品説明
    $csvstr .= $row['i_comp'] . ",";        //仕入れ先
    $csvstr .= $row['country'] . ",";       //生産国
    $csvstr .= $row['price'] . ",";         //価格
    $csvstr .= $row['w_price'] . ",";       //仕入れ価格
    $csvstr .= $row['stock'] . ",";         //在庫数
    $csvstr .= $row['day'] . "\r\n";        //入出荷日
}
//CSV出力
$fileNm = "zaiko.csv";                      //ダウウンロードファイル名：zaiko.csv
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='.$fileNm);
echo mb_convert_encoding($csvstr, "SJIS", "UTF-8"); //Shift-JISに変換したい場合のみ
exit();
?>
<p>※ダウンロードしました。</p>

<a href="zaikokakunin.php">在庫確認画面へ</a>




