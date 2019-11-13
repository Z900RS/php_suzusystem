<?php
session_start();
// セッションの登録データを削除
session_destroy();
print "ログアウト処理完了";
?>

<!DOCTYPE html>
<html>
<head>
    <title>ログアウト画面</title>
</head>
<link href="../css/zaiko.css" rel="stylesheet">
<body>
<br><br><a href="index_login.php">ログイン画面へ</a>

</body>
</html>



