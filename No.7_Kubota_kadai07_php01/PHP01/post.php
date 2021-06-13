<html>
<head>
	<meta charset="utf-8">
	<title>POST練習</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<body>

<?php

	$dates = array();
	$lines = file("data/data3.txt");
	// データの各行を取り出し→シリアル化解除→2番目（numbers）を配列に挿入。
	foreach ( $lines as $line ) {
	array_push($dates,unserialize($line)[3]);	
	}
	// 配列をphp→javascriptに移行
	$json_array = json_encode($dates);
?>

<form action="post_confirm.php" method="post" name="myform" onsubmit="return checkText()">
	お名前: <input type="text" name="name">
	EMAIL: <input type="text" name="mail">
	好きな数字: <input type="number" name="number">
	日付：<input type="date" name="date">
	<input type="submit" value="送信">
</form>

<script type="text/javascript">
// 配列をphpから受け取り
let dates_js = <?php echo $json_array; ?>;

	var checkText = function() {
      var name = document.myform.name.value;
	  var mail = document.myform.mail.value;
	  var number = document.myform.number.value;
	  var date = document.myform.date.value;

      if(name == "") {
          alert('名前を入力してください！');
          return false;
      }
	  else if(mail == "") {
          alert('メールアドレスを入力してください！');
          return false;
      }
	  else if(number == "") {
          alert('好きな数字を入力してください！');
          return false;
      }
	  else if(date == "") {
          alert('日付を入力してください！');
          return false;
      }
	  else if(!(dates_js.indexOf(date) == -1)) {
          alert('その日は既に満席です');
          return false;
      }
	  else{
		true;
	  }
    }

</script>

<ul>
	<li><a href="index.php">戻る</a></li>
</ul>

</body>
</html>