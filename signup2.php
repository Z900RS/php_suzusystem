

<!DOCTYPE html>
<html>
<head>
    <title>新規登録</title>
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
$user_name = $_POST['user_name'];
$sql = $pdo->prepare("SELECT name FROM userdata WHERE name = $user_name");
$sql->execute(array($user_name));

if($user_name===$sql['name']){
    echo  '入力したユーザIDは既に使用されています';
    exit();
}

if (!$name = filter_var($_POST['user_name'], FILTER_VALIDATE_EMAIL)) {
    echo '入力された値が不正です。';
    return false;
}


//パスワードの正規表現
if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
    echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
    return false;
}
//登録処理
try {
    $stmt = $pdo->prepare("insert into userdata (name,password) value(?, ?)");
    $stmt->execute([$name, $password]);
    echo '登録完了';
} catch (\Exception $e) {
    echo '登録済みのメールアドレスです。';
}
?>
<br><br><a href="signup.php">戻る</a>
</body>
</html>



