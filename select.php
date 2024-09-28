<?php
//1.  DB接続します(insert.phpで入力したものと基本同じ)
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

//２．データ登録SQL作成(insert.phpで入力したものと基本同じ)
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();  //true or falseが入る

//３．データ表示
// $view=""; //無視
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}

//全データ取得
 //fetchALL＝繰り返し全部取ってくるの意味、$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); →そのまま使用する
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う(毎回コピペでOK)
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマークアプリ簡易版</title>
<style>
div{padding: 10px;font-size:16px;}
td{border: 1px solid black;}
</style>

</head>
<body id="main">

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"></div>

    <!-- データの表示のために記入 -->
     <!-- foreach($values as $values)→PHPが実行される -->
      <!-- pタグの中はhtmlで、phpの中に書き込める -->
      <table>
      <?php foreach($values as $value){ ?>  
      <tr>
        <td><?=$value["id"]?></td> 
        <td><?=$value["title"]?></td>   
        <td><?=$value["url"]?></td>   
        <td><?=$value["comment"]?></td>   
        <td><?=$value["indate"]?></td>   
<?php } ?>
</table>
</div>
<!-- Main[End] -->


<script>
  //JSON受け取り(グラフとかいろんなことに使える)
//  $a = '<?=$json?>';
//  const obj = JSON.parse($a);
//  console.log(obj);


</script>
</body>
</html>
