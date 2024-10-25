<?php
require_once('../tools.php');

$isbnlist = array(
  9784418231300,
  9784418231379,
  9784418241101,
  9784418241163,
  9784418241231,
  9784418241279,
  9784418231331,
  9784418241033,
  9784418241149,
  9784418241217,
  9784418241255,
  9784418231324,
  9784418241026,
  9784418241132,
  9784418241200,
  9784418241248,
);

// $publisher_id = 24; // 吉川弘文館 pro stg
// $publisher_id = 86; // 学陽書房 pro stg
// $publisher_id = 1125; // 竹書房 pro
$publisher_id = 1165; // 世界文化社 pro

/**
* 環境
*/
$env = 'pro';
// $env = 'stg';
// $env = 'docker';

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

ob_start();

$i = 0;
foreach ($isbnlist as $k => $v) {
  $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id} and ebook_status = false;";
  // $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id} and ebook_status = true;";
  // $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name,isbn,publisher_id from books where management_code = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name from authors where name = '{$v}' and publisher_id = {$publisher_id};";
  foreach ($db->query($sql) as $row) {
    echo $row['isbn'];
    echo "||"; // 後で置換用の区切り文字
    echo $row['id'];
    echo "||"; // 後で置換用の区切り文字
    echo $row['name'];
    echo "||"; // 後で置換用の区切り文字
  }

  echo "<br>";
  $i++;
  // if($i > 20) {
    // 20回まわったら ページ出力
    flush();
    ob_flush();
    $i = 0;
  // }
}
flush();
ob_flush();

ob_end_flush();

echo "end!!";
exit();
