<?php
    require 'funcs.php';

    // Get the unique number from the GET parameters
    $unique_num = $_GET['unique_num'];

    // Connect to the database
    try {
        $pdo = db_conn();
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }

    // Prepare the SQL statement to get the existing record
    $stmt = $pdo->prepare("SELECT * FROM php_kadai02 WHERE unique_num = :unique_num");
    $stmt->bindValue(':unique_num', $unique_num, PDO::PARAM_INT);
    $status = $stmt->execute();

    // Fetch the existing record
    if ($status == false) {
        $error = $stmt->errorInfo();
        exit("SQL Error:".$error[2]);
    } else {
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">過去登録した書籍を見る←Click</a></div>
    </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="./update_process.php">
    <div class="jumbotron">
<fieldset>
    <legend>更新する書籍情報を入力してください</legend>
    <label>書籍の名前：<input type="text" name="title" value="<?= htmlspecialchars($res['title'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
    <label>書籍へのリンク：<input type="text" name="url" value="<?= htmlspecialchars($res['url'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
    <label>コメント（省略可）<textArea name="comments" rows="4" cols="40"><?= htmlspecialchars($res['comments'], ENT_QUOTES, 'UTF-8') ?></textArea></label><br>
    <input type="hidden" name="unique_num" value="<?= htmlspecialchars($res['unique_num'], ENT_QUOTES, 'UTF-8') ?>">
    <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
