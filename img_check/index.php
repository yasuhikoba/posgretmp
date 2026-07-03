<?php
require_once('../tools.php');
tools::loadEnv();

ob_start();

/**
 * 環境
 */
require_once('../config.php');

// $env = 'pro';
$env = 'stg';

$publisher_id = PUBLISHER_IDS['日刊工業新聞社'][$env];

$imghost = 'https://hondana-image.s3.amazonaws.com/book/image/';
$pagehost = 'https://pub.nikkan.co.jp/';

if ($env == 'stg') {
  $imghost = 'https://hondana-cms-image.s3.amazonaws.com/book/image/';
}

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

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
for ($i = 0; $i < $page; $i++) {
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
  while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    // 画像の存在チェック
    $imgurl = $imghost . $row['id'] . '/' . $row['image'];
    if (@file_get_contents($imgurl, false, null, 0, 100)) {
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
