<?php
require_once('../tools.php');

$isbnlist = array(
  '41818312000001804251',
  '41822824000002204121',
  '41816144000001612051',
  '41812105000001203151',
);

// $publisher_id = 24; // 吉川弘文館 pro stg
// $publisher_id = 86; // 学陽書房 pro stg
// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1165; // 世界文化社 pro
$publisher_id = 1177; // 世界文化社 stg
// $publisher_id = 1210; // 国際商業出版 stg

/**
* 環境
*/
// $env = 'pro';
$env = 'stg';
// $env = 'docker';

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

ob_start();

$i = 0;
foreach ($isbnlist as $k => $v) {
  // $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id} and ebook_status = false;";
  // $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id} and ebook_status = true;";
  // $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name,isbn,publisher_id from books where management_code = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name from authors where name = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name,jan_code,case ebook_status when true then '1' else '0' end as ebook_status from books where publisher_id = {$publisher_id} and jan_code = '{$v}' order by ebook_status;";
  $sql = "select id,name,management_code,case ebook_status when true then '1' else '0' end as ebook_status from books where management_code = '{$v}' and publisher_id = {$publisher_id};";
  foreach ($db->query($sql) as $row) {
    // echo $row['isbn'];
    // echo "||"; // 後で置換用の区切り文字
    // echo $row['jan_code'];
    echo $row['management_code'];
    echo "||"; // 後で置換用の区切り文字
    echo $row['id'];
    echo "||"; // 後で置換用の区切り文字
    echo $row['name'];
    echo "||"; // 後で置換用の区切り文字
    echo $row['ebook_status'];
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
