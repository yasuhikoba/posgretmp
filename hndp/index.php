<?php
require_once('../tools.php');

$isbnlist = array(
  4910076970144,
  4910076970342,
  4910076970441,
  4910076970540,
  4910076970649,
  4910076970748,
  4910076970847,
  4910076970946,
  4910076971042,
  4910191991239,
  4910191990249,
  4910191990447,
  4910186770146,
  4910186770542,
  4910100430149,
  4910100430248,
  4910100440247,
  4910100430347,
  4910100430446,
  4910100430545,
  4910100430644,
  4910100430743,
  4910100430842,
  4910100430941,
  4910100431047,
  4910022470247,
  4910022470445,
  4910022470643,
  4910022470841,
  4910022471046,
  4910024330143,
  4910024330242,
  4910024330341,
  4910024330440,
  4910024330549,
  4910024330648,
  4910024330747,
  4910024330846,
  4910024330945,
  4910024331041,
  4910076980341,
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
