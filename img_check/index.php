<?php

ob_start();

$publisher_id = 1046;
$debug = false;
$imghost = 'https://hondana-image.s3.amazonaws.com/book/image/';
$pagehost = 'https://pub.nikkan.co.jp/';

if($debug) {
  // STG用
  $publisher_id = 1022;
  $dsn = 'pgsql:dbname=dbeu4230n0kuct;host=ec2-100-26-113-127.compute-1.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'bmdxjjfoahyizi', '282992d73a19e3fc0fbc6c86dab8e2e07e7f766137b9b58d6c13109c3a1dff39');
  $publisher_key .= '-stg';
  $imghost = 'https://hondana-cms-image.s3.amazonaws.com/book/image/';
} else {
  // 本番用
  $dsn = 'pgsql:dbname=d3uldjpkj3ctch;host=ec2-52-204-191-143.compute-1.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'u79urs9of0un6s', 'p34d02ab02bf28b14e66b09bc464b4b3e75840bfa9418dba10202fbe1840f91ec');
  $publisher_key .= '-pro';
}

$sql = "select count(*) as cnt
  from books as b
  where b.publisher_id = {$publisher_id} and image is not null;";

$sth = $db->query($sql);
$row = $sth->fetch(PDO::FETCH_ASSOC);
$count = $row['cnt'];

$limit = 20;
$page = ceil($count / $limit);

// 一定数ごとにループ
// 途中で処理が止まってしまった場合は 下記の $i の初期値を変更して再実行させる
// 3000件目からスタートさせる場合 3000 / 20 → 150を設定する
for ($i=0; $i < $page; $i++) {
  $offset = $limit * $i;
  $sql = "select DISTINCT
  b.id,b.name,b.image

  from books as b

  where b.publisher_id = {$publisher_id} and image is not null

  order by b.id

  limit {$limit} offset {$offset}
  ;";

  // bookのループ（1行）
  $sth = $db->query($sql);
  while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    // 画像の存在チェック
    $imgurl = $imghost . $row['id'] . '/' . $row['image'];
    if(@file_get_contents($imgurl,false,null,0,100)) {
      echo $row['id'] . " ok<br>";
      // echo $row['id'] . " ok " . $imgurl . "<br>";
    } else {
      // echo $row['id'] . " ng " . $imgurl . "<br>";
      echo $row['id'] . " ng " . $pagehost . "book/b" . $row['id'] . ".html<br>";
    }

    flush();
    ob_flush();
  }
}

flush();
ob_flush();

ob_end_flush();

echo "end!!";

exit();
