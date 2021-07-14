<?php
session_start();
require_once("funcs.php");

$title = $_POST["name"];
$url = $_POST["url"];
$comment = $_POST["content"];
$pricing = 1200;

if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
  //ファイル名を取得
  $file_name = $_FILES["upfile"]["name"];
  //一時保存パス作成
  $tmp_path  = $_FILES["upfile"]["tmp_name"];
  //拡張子取得
  $extension = pathinfo($file_name, PATHINFO_EXTENSION);
  //ユニークなファイル名を生成
  $file_name = date("YmdHis").md5(session_id()) . "." . $extension;
  // FileUpload [--Start--]
  $img="";//空の変数
  $file_dir_path = "upload/".$file_name;//uploadフォルダにファイルを移動
  if ( is_uploaded_file( $tmp_path ) ) {
      if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
          chmod( $file_dir_path, 0644 );//ファイルの権限を設定
          require_once("funcs.php");
          //2. DB接続します
          $pdo = db_conn();
          $sql = "INSERT INTO gs_bm_table( id,title,URL,comment,indate,pricing,img)VALUES( NULL, :title, :URL, :comment, sysdate(),:pricing,:img)";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(':img', $file_name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
          $stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
          $stmt->bindValue(':URL', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
          $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
          $stmt->bindValue(':pricing', $pricing, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
          $status = $stmt->execute();
          //４．データ登録処理後
          if ($status == false) {
              sql_error($stmt);
          } else {
              $img = '<img src="'.$file_dir_path.'">';
              header('Location: bookmark.php');
          }
      } else {
          // echo "Error:アップロードできませんでした。";
      }
  }
}else{
   $img = "画像が送信されていません";
}


// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．bookmark.phpへリダイレクト
  header('Location: bookmark.php');
}
?>
