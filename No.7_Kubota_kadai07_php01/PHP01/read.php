<?php

$lines = file("data/data3.txt");
echo (unserialize($lines[2])[3]);

?>

<table border="1">
    <tr>
      <th>名前</th>
      <th>メールアドレス</th>
      <th>好きな数字</th>
      <th>日付</th>
    </tr>
    <?php foreach ($lines as $line) : ?>
    <?php $line2 = unserialize($line);?>
    <!-- 配列の要素を1行ずつ<li>タグに埋め込む -->
    <tr>
        <th><?php echo $line2[0]; ?></th>
        <th><?php echo $line2[1]; ?></th>
        <th><?php echo $line2[2]; ?></th>
        <th><?php echo $line2[3]; ?></th>
    </tr>

    <?php endforeach; ?>

</table>

<p class="here"></p>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<body>
  <canvas id="stage"></canvas>
</body>

<?php
	$numbers = array();
	$lines = file("data/data3.txt");
	// データの各行を取り出し→シリアル化解除→2番目（numbers）を配列に挿入。
	foreach ( $lines as $line ) {
	array_push($numbers,unserialize($line)[2]);	
	}
	// 配列をphp→javascriptに移行
	$json_array = json_encode($numbers);
?>

<script>

// 配列をphpから受け取り
let numbers_js = <?php echo $json_array; ?>;

let minus=0;//マイナス
let zero=0; //ゼロ
let under10=0 //10以下
let under100=0 //100以下
let over100=0 //100以上

for(var i =0; i<numbers_js.length; i++){
    if (numbers_js[i] < 0){
        minus +=1;
    } 
    else if(numbers_js[i]==0){
        zero +=1;
    }
    else if(numbers_js[i]<10){
        under10 +=1;
    }
    else if(numbers_js[i]<100){
        under100 +=1;
    }
    else {
        over100 +=1;
    }    
}

console.log(under100);

//「月別データ」
var mydata = {
  labels: ["~-1", "0", "1~9", "10~99", "100~"],
  datasets: [
    {
      label: '回答者数',
      hoverBackgroundColor: "rgba(255,99,132,0.3)",
      data: [minus,zero,under10,under100,over100],
    }
  ]
};

//「オプション設定」
var options = {
  title: {    
    display: true,
    text: '好きな数字の割合'
  }
};

var canvas = document.getElementById('stage');
var chart = new Chart(canvas, {

  type: 'bar',  //グラフの種類
  data: mydata,  //表示するデータ
  options: options  //オプション設定

});

</script>

<ul>
    <li><a href="index.php">戻る</a></li>
</ul>