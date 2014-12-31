<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<?php
 //POSTの処理
 $id = isset($_POST['id']) ? $_POST['id'] : "false";
 ?>
 <html>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <head>
 <title>練習問題12 - 簡易データベースの動作確認 / PHPを学ぼう！</title>
 </head>
<body bgcolor="#FFFFFF">
<h1 style="font-size:14pt">◆簡易データベース</h1>
<?php
//ファイル名の指定
$file_name = "data.csv";
//echo 成功;

//処理の分岐
if($id != "false"){
$fp = fopen($file_name, "a+") or die('ファイルオープンエラー！');
//データを$arrayに代入（多元配列）
while(!feof($fp)){
$data = fgets($fp);
//var_dump( $data );
$array[] = explode(",", mb_convert_encoding($data, "UTF-8", "auto"));
}

fclose($fp);

//目的のデータの修得
for($i=0; $i<count($array); $i++){
if($array[$i][0] == $id){
$new_data = $array[$i];
//var_dump( $new_data );
break;
}
}
}
$new_data = isset($new_data) ? $new_data : "false" ;
?>
<form action="index.php" method="POST">
<input type="text" name="id">
<input type="submit" name="Submit" vale="検　索">
</form>
<?php
if($id != "false"){
if($new_data == "false" || $id == ""){
echo "データが存在しません。";
}else{
echo '▼検索結果';
echo '<hr>';
echo '商品番号: '.$new_data[0].'<br />';
echo '名　称: '.$new_data[1].'<br />';
echo '単　価: '.$new_data[2].'<br />';
echo '在　庫: '.$new_data[3].'<br />';
}
}
?>
</body>
</html>