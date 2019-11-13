<?php
//セッションスタート
session_start();

//phpinfo();
$error_message = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["user_name"])) {  // emptyは値が空のとき
       echo $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
       echo $errorMessage = 'パスワードが未入力です。';
    }
//    var_dump($_POST["user_name"]);
//    var_dump($_POST["password"]);

    if (!empty($_POST["user_name"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $user_name = $_POST["user_name"];


        // 2. ユーザIDとパスワードが入力されていたら認証する
//        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO("mysql:dbname=zaiko;host=localhost;charset=utf8mb4",
                "root",
                "");

            if ($pdo) {
                //    echo '成功';
            } else {
                echo '失敗';
            }

            $stmt = $pdo->prepare("SELECT * FROM userdata WHERE name = ?");
            $stmt->execute(array($user_name));

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($_POST['password'], $row['password'])) { //DBのパスワード復号化（入力値：DBの値）
                session_regenerate_id(true);


                // 入力したIDのユーザー名を取得
                $id = $row['id'];
                $sql = "SELECT * FROM userdata WHERE id = $id";  //入力したIDからユーザー名を取得
                $stmt = $pdo->query($sql);
                foreach ($stmt as $row) {
                    $row['name'];  // ユーザー名
                }
                $_SESSION["NAME"] = $row['name'];
                $login_success_url = "zaikokakunin.php";
                header("Location:{$login_success_url}");
                exit();  // 処理終了
            } else {
                // 認証失敗
                echo $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
            }
        } catch (PDOException $e) {
           echo $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ログイン画面</title>
</head>
<link href="../css/zaiko.css" rel="stylesheet">
<body>
<div class="login">
    <div class="img">
        <img src="../img/logo.png" alt="logo" width="380" height="100">
    </div>
<form action="index_login.php" method="post">
    <p>ログインID：<input type="text" name="user_name"></p>
    <p>パスワード：<input type="password" name="password"></p>
    <div class="botan">
        <input type="submit" name="login" value="ログイン">
    </div>
</form>
</div>

<a href="signup.php">新規登録</a>

</body>
</html>



