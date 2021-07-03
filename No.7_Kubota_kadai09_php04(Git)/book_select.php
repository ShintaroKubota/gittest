<?php

session_start();
require_once('funcs.php');
loginCheck();

//1.  DB接続します
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  $view .= "<table border='1'>";
  $view .= "<tr><th>書籍名</th><th>書籍URL</th><th>コメント</th><th>登録日</th></tr>";
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){    
    $view .= "<tr><th>";
    $view .= '<a href="detail.php?id='.$result["id"].'">';
    $view .= h($result['title']);
    $view .= '</a>';
    $view .= '</th><th>'.h($result['URL']).'</th><th>'.h($result['comment']).'</th><th>'.h($result['indate']).'</th></tr>';
  }
  $view .= "</table>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧</title>
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
      <a class="navbar-brand" href="bookmark.php">データ登録</a>
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
