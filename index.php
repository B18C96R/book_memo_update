<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
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
<form method="POST" action="./insert.php">
  <div class="jumbotron">
<fieldset>
    <legend>気に入った本をひたすら貯めていくだけのDB</legend>
    <label>書籍の名前：<input type="text" name="title"></label><br>
    <label>書籍へのリンク：<input type="text" name="url"></label><br>
    <label>コメント（省略可）<textArea name="comments" rows="4" cols="40"></textArea></label><br>
    <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
