<?php

require 'funcs.php';

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = db_conn();
} catch (PDOException $e) {
  exit('DB Connection Error:'.$e->getMessage());
}

$sql = "SET @num := 0";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = "UPDATE php_kadai02 SET unique_num = @num := (@num + 1)";
$stmt = $pdo->prepare($sql);
$stmt->execute();

//２．データ登録SQL作成
$sql = "SELECT * FROM php_kadai02";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view = '<table class="table table-striped">';
$view .= "<thead><tr><th>Unique Number</th><th>Title</th><th>URL</th><th>コメント</th><th>登録時間</th><th>Actions</th></tr></thead>";
$view .= "<tbody>";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL Error:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tr>";
    $view .= "<td>".htmlspecialchars($res['unique_num'], ENT_QUOTES, 'UTF-8')."</td>";
    $view .= "<td>".htmlspecialchars($res['title'], ENT_QUOTES, 'UTF-8')."</td>";
    $view .= "<td>".htmlspecialchars($res['url'], ENT_QUOTES, 'UTF-8')."</td>";
    $view .= "<td>".htmlspecialchars($res['comments'], ENT_QUOTES, 'UTF-8')."</td>";
    $view .= "<td>".htmlspecialchars($res['time'], ENT_QUOTES, 'UTF-8')."</td>";
    // $view .= "<td><a href='delete.php?unique_num=".htmlspecialchars($res['unique_num'], ENT_QUOTES, 'UTF-8')."'>Delete</a></td>";
    $view .= "<td><a href='delete.php?unique_num=".htmlspecialchars($res['unique_num'], ENT_QUOTES, 'UTF-8')."'>Delete</a> | <a href='bm_update.php?unique_num=".htmlspecialchars($res['unique_num'], ENT_QUOTES, 'UTF-8')."'>Update</a></td>";
    $view .= '</tr>';
  }
  $view .= "</tbody></table>";
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録画面に戻る</a>
      <!-- <a class="navbar-brand" href="bm_update.php">データの更新</a> -->
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
