<?php
//1. POSTデータ取得
//[title,url,comment,indate]idは省略
$title =   $_POST["title"];
$url =  $_POST["url"];
$comment =    $_POST["comment"];
// $indate = $_POST["indate"];


//2. mySQLのDBへ接続 (try~から}までPHPの文法をセットでそのままコピーして使用)

// ファイルをDBに見立てた時はfopenで開いていたが、今回はDB特有の関数を用意
// 全体的にはtry以降の処理でエラーが出たらcatchしてexitでエラーを表示するの意味
// PDO＝PHPデータオブジェクト＝DBに接続するための関数
           // 'mysql:dbname=******; ＝*部分はデータベース名を入れる
// root＝データベースのid名を示している!!!! XAMPPではidがrootでパスワードは空
// ('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');さくらサーバにアップの場合はlocalhost(→さくらのDBアドレスへ)＆root（→さくらのidへ）を変更、最後の'’はパスワード入力箇所だがXAMPPの場合は空白でOK
// exit('DB_CONNECT:'.$e->getMessage());→DB_CONNECTと入れる→エラーが出た時にDB_CONNECTと出れば、 $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');がおかしいとわかる
try {
  //Password:MAMP='root',XAMPP='' MAMPの場合のパスワードはroot、XAMPPは空
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}


//３．データ登録SQL作成（毎回この形で使用）

//  $sql = "";に、insert文「INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(:name,:email,:age,:naiyou,sysdate());」を挿入する
        // "INSERT INTO テーブル名入れる!!(id,name,~~)のid（& NULL)は省略可 注意：id取らないとDBに反映されない
$sql = "INSERT INTO gs_bm_table(title,url,comment,indate)VALUES(:title,:url,:comment,sysdate());";
// $pdo->prepareはSQLをセットする関数、($sql);変数で上記 "INSERT INTO gs_an_table〜を読み込む
// $stmtとは、ステートメントのこと
$stmt = $pdo->prepare($sql);
// $stmtの中（->）の、bindValueという関数の()内に「sql.sql」ファイルで作成＝上記$sqlに埋め込んだバインド変数を書き込む
// $stmt内、POSTで受け取った値「$name」を、:nameに渡す（以下emailなど同じ）意味
// PDO::PARAM_STRは、飛んできたデータ(nameなど)がどの型か？を示している。文字列(varchar)ならPDO::PARAM_STR、INT（数値）ならPDO::PARAM_INT
// PDO::PARAM_***の「***」部分はネット検索すれば小数点の場合は？など該当する型が出てくる
// 日付も文字列なので「PDO::PARAM_STR」使用

// // 今回は、下記バインド変数（POSTデータをそれぞれのプレースホルダーにバインド）
$stmt->bindValue(':title',   $title,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',  $url,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',    $comment,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':naiyou', $indate,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();  //true or false

//４．データ登録処理後（このまま使用）

// もしも、SQLが失敗していたら
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  // SQL_ERRORなど、どこがエラーかわかる名前を自分がわかるようにつける
  // エラーが出たら上記3番のデータ登録SQLのどこかが間違っているということ
  exit("SQL_ERROR:".$error[2]);
}else{     //成功したら下記↓
  //５．index.phpへリダイレクト (index.phpに画面を自動で遷移させる)
  header("Location: index.php");  //Lは必ず大文字、半角スペース必ず
  exit();


}
?>
