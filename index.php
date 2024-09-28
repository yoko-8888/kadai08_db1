<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブックマークアプリ簡易版</title>
    <style>
        body {
            background-image: url('img/img1.png'); /* 画像パスを指定 */
            background-size: cover; /* 画像を全体にフィットさせる */
            background-position: center center; /* 画像を中央に配置 */
            background-repeat: no-repeat; /* 画像を繰り返さない */
            height: 100vh; /* ビューポートの高さを100%に設定 */
            margin: 0; /* 余白をなくす */
        }
        .jumbotron {
            background-color: rgba(255, 255, 255, 0.8); /* 背景を少し透明にしてテキストを読みやすくする */
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<?php
    $d = date("Y年m月d日 H時i分s秒");
echo $d;
$d = date("s");
// if($d >= 10){
    // echo '<body style="background:pink;">';
// }else{
    // echo '<body style="background:green;">';
// }

?>

<!-- HTML -->
    <h1>BOOK登録フォーム</h1>

    <!-- /* h1の文字色を白に指定 */ -->
    <style>
        h1 {
            color: greenyellow;
        }
    </style>

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>about your book</legend>
     <label>TITLE：<input type="text" name="title"></label><br>
     <label>URL：<input type="text" name="url"></label><br>

     <label><textArea name="comment" rows="10" cols="40"></textArea></label><br>
     <label>DATE：<input type="text" name="indate"></label><br>

     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
