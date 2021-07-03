<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user registration_bm.php">新規ユーザー登録</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form name="form1" method="POST" action="login_act.php">
  <fieldset>
    <legend>ログインフォーム</legend>
    <label>ユーザー名：<input type="text" name="name"></label><br>
    <label>パスワード：<input type="password" name="pw"></label><br>
    <input type="submit" value="LOGIN">
  </fieldset>
</form>
<!-- Main[End] -->

<div class="navbar-header"><a class="navbar-brand" href="book_select2.php">ログインせずに簡易版を閲覧する</a></div>

</body>
</html>
