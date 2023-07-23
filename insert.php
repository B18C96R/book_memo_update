<?php

require 'funcs.php';

ini_set('display_errors', 1);

//1. POSTデータ取得
//$title = filter_input( INPUT_GET, ","title" ); //こういうのもあるよ
//$url = filter_input( INPUT_POST, "url" ); //こういうのもあるよ
$title = $_POST['title'];
$url = $_POST['url'];
$comments = $_POST['comments'];


//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  // $pdo = new PDO('mysql:host=localhost;dbname=php_kadai02', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
  $pdo = db_conn();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  exit('DB Connection Error:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO php_kadai02(title,url,comments,time)VALUES(:title, :url, :comments, sysdate());");
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comments', $comments, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

$sql = "SET @num := 0";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = "UPDATE php_kadai02 SET unique_num = @num := (@num + 1)";
$stmt = $pdo->prepare($sql);
$stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_Error:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();


}
?>
