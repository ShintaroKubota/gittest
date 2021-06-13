<?php

// フォームから送られてきたデータを取得し変数に代入
$name = $_POST["name"];
$mail = $_POST["mail"];
$number = $_POST["number"];
$date = $_POST["date"];

// // .txt fileにデータを保存する処理
// $file = fopen("data/data2.txt","a"); //対象のファイルを開く
// fwrite($file, $name."\n".$mail."\n".$number."\n".$date."\n"); //ファイルにデータを書き込む
// fclose($file); //ファイルを閉じる
function h($value){
    return htmlspecialchars($value,ENT_QUOTES);
}

//ファイルに保存したいデータ（文字列、配列、オブジェクトなんでもOK）
$data = array($name,$mail,$number,$date);
//ファイルのパス
$file_path = "data/data3.txt";
//シリアル化
$data_serialize = serialize($data)."\n";

//ファイルに保存
file_put_contents($file_path, $data_serialize, FILE_APPEND | LOCK_EX);
//保存したファイルのパーミッションを644にする
chmod($file_path, 0644);

?>

<html>
<head>
    <meta charset="utf-8">
    <title>POST（受信）</title>
</head>

<body>

    <p>以下の通り、登録致しました。</p>

    <ul>
        <li> お名前：<?= h($name); ?> </li>
        <li> Mail：<?= h($mail); ?> </li>
        <li> 好きな数字：<?= h($number); ?> </li>
        <li> 日時：<?= h($date); ?> </li>
    </ul>

    <ul>
        <li><a href="index.php">戻る</a></li>
    </ul>

</body>
</html>