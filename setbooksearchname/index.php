<?php
require_once('../tools.php');

ob_start();

$publisher_id = 1125; // 竹書房 pro
$debug = true;

if($debug) {
  // Docker用
  // 先に Postgres側を起動しておかないと IPが認識できず、アクセスできない
  $dsn = 'pgsql:dbname=app_development;host=172.27.114.177;port=15432';
  $db = new PDO($dsn, 'postgres', 'password');
  $publisher_id = 1002; // docker

  // // STG用
  // $publisher_id = 1022;
  // $dsn = 'pgsql:dbname=dbeu4230n0kuct;host=ec2-100-26-113-127.compute-1.amazonaws.com;port=5432';
  // $db = new PDO($dsn, 'bmdxjjfoahyizi', '282992d73a19e3fc0fbc6c86dab8e2e07e7f766137b9b58d6c13109c3a1dff39');
} else {
  // 本番用
  $dsn = 'pgsql:dbname=d3uldjpkj3ctch;host=ec2-52-204-191-143.compute-1.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'u79urs9of0un6s', 'p34d02ab02bf28b14e66b09bc464b4b3e75840bfa9418dba10202fbe1840f91ec');
}

$sql = "select count(*) as cnt
  from books
  where publisher_id = {$publisher_id} and freetext_search is null;";

$sth = $db->query($sql);
$row = $sth->fetch(PDO::FETCH_ASSOC);
$count = $row['cnt'];

$limit = 20;
$page = ceil($count / $limit);

// 一定数ごとにループ
// 途中で処理が止まってしまった場合は 下記の $i の初期値を変更して再実行させる
// 3000件目からスタートさせる場合 3000 / 20 → 150を設定する

$itemlist = array(
  'volume',
  'outline',
  'outline_abr',
  'sub_name',
  'sub_kana',
  'explain',
  'content',
  'keyword',
  'kana',
  'c_code',
  'magazine_code',
  'isbn',
);

for ($i=0; $i <= $page; $i++) {
  $sql = "select DISTINCT
    id,
    name,
    volume,
    outline,
    outline_abr,
    sub_name,
    sub_kana,
    explain,
    content,
    keyword,
    kana,
    c_code,
    magazine_code,
    isbn,
    name_search,
    freetext_search

    from books

    where publisher_id = {$publisher_id} and freetext_search is null

    order by id

    limit {$limit}
    ;";

  // bookのループ（1行）
  $sth = $db->query($sql);
  while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $name_search = tools::convertSearchText($row['name']);
    $name_search = str_replace("'","''",$name_search);
    $freetext_search = array();
    $freetext_search[] = tools::convertSearchText($row['name']);
    foreach ($itemlist as $k => $v) {
      if(!empty($row[$v])) {
        $freetext_search[] = tools::convertSearchText($row[$v]);
      }
    }
    $freetext_search = implode("|", $freetext_search);
    $freetext_search = str_replace("'","''",$freetext_search);
    $isql = "update books set name_search = '{$name_search}',freetext_search = '{$freetext_search}',updated_at = now() where id = {$row['id']} and publisher_id = {$publisher_id};";
    if($db->exec($isql) === false) {
      echo "not update book id {$row['id']}<br>";
    } else {
      echo "update success book id {$row['id']}<br>";
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
