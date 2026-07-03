<?php
require_once('../tools.php');
tools::loadEnv();

$isbnlist = array(
  '3088',
  '3376',
  '3554',
  '3763',
  '3806',
  '3819',
  '3338',
);

/**
 * 環境
 */
require_once('../config.php');

// $env = 'pro';
$env = 'stg';
// $env = 'docker';

$publisher_id = PUBLISHER_IDS['慶應義塾大学出版会'][$env];

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

ob_start();

foreach ($isbnlist as $k => $v) {
  // $sql = "select id,name,isbn from books where isbn = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name,isbn from books where isbn = '{$v}' and publisher_id = {$publisher_id} and ebook_status = false;";
  // $sql = "select id,name,isbn from books where isbn = '{$v}' and publisher_id = {$publisher_id} and ebook_status = true;";
  // $sql = "select id,name,isbn from books where isbn = '{$v}' and publisher_id = {$publisher_id};";
  $sql = "select id,name,management_code from books where management_code = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name from authors where name = '{$v}' and publisher_id = {$publisher_id};";
  // $sql = "select id,name,jan_code,case ebook_status when true then '1' else '0' end as ebook_status from books where publisher_id = {$publisher_id} and jan_code = '{$v}' order by ebook_status;";
  // $sql = "select id,name,management_code,case ebook_status when true then '1' else '0' end as ebook_status from books where management_code = '{$v}' and publisher_id = {$publisher_id};";
  // // フォーマット関連項目追加
  // $sql = "select b.id,b.name,b.isbn,b.format_primary,b.format_group_id,count(b2.id) as bookcount,ARRAY_TO_STRING(ARRAY_AGG(concat(b2.id,'-',b2.book_format_other) ), '|') AS bookid_list from books as b left join books as b2 on b.format_group_id = b2.format_group_id where b.publisher_id = {$publisher_id} and b.isbn = '{$v}' group by b.id,b.name,b.isbn,b.format_primary,b.format_group_id;";

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
    // if ($row['format_primary']) {
    //   echo 'true';
    // } else {
    //   echo 'false';
    // }
    // echo "||"; // 後で置換用の区切り文字
    // echo $row['format_group_id'];
    // echo "||"; // 後で置換用の区切り文字
    // echo $row['bookcount'];
    // echo "||"; // 後で置換用の区切り文字
    // echo $row['bookid_list'];
    // echo "||"; // 後で置換用の区切り文字
    // echo $row['ebook_status'];
    // echo "||"; // 後で置換用の区切り文字
  }

  echo "<br>";

  flush();
  ob_flush();
}
flush();
ob_flush();

ob_end_flush();

echo "end!!";
exit();
