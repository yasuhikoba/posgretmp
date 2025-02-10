<?php
require_once('../tools.php');

ob_start();

// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1276; // 丸善出版 stg
// $publisher_id = 1203; // 丸善出版 pro
$publisher_id = 1204; // 光文社 pro
// $publisher_id = 1165; // 世界文化社 pro

/**
* 環境
*/
// $env = 'pro';
// $env = 'stg';
$env = 'docker';

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

$sql = "select count(*) as cnt
  from books
  where publisher_id = {$publisher_id} and freetext_search is null;";

$sth = $db->query($sql);
$row = $sth->fetch(PDO::FETCH_ASSOC);
$count = $row['cnt'];

$limit = 20;
$page = ceil($count / $limit);

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
