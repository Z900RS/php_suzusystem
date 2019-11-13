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
    <title>アップロード画面</title>
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

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"])) {
        chmod("files/" . $_FILES["upfile"]["name"], 0644);
        echo $_FILES["upfile"]["name"] . "をアップロードしました。";
    } else {
        echo "ファイルをアップロードできません。";
    }
} else {
    echo "ファイルが選択されていません。";
}

?>
<p>※アップロードしました</p>

<a href="zaikokakunin.php">在庫確認画面へ</a>
</body>
</html>



