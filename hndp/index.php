<?php
require_once('../tools.php');

$isbnlist = array(
  4910039551144,
  4910039551045,
  4910039550949,
  4910039550840,
  4910039550741,
  4910039550642,
  4910039550543,
  4910039550444,
  4910039550345,
  4910039550246,
  4910039550147,
  4910039551236,
  4910039551137,
  4910039551038,
  4910039550932,
  4910039550833,
  4910039550734,
  4910039550635,
  4910039550536,
  4910039550437,
  4910039550338,
  4910039550239,
  4910039550130,
  4910039551229,
  4910039551150,
  4910039551021,
  4910039550925,
  4910039550826,
  4910039550727,
  4910039550628,
  4910039550529,
  4910039550420,
  4910039550321,
  4910039550222,
  4910039550123,
  4910039551212,
  4910039551113,
  4910039551014,
  4910039550918,
  4910039550819,
  4910039550710,
  4910039550611,
  4910039550512,
  4910039550413,
  4910039550314,
  4910039550215,
  4910039550116,
  4910039551205,
  4910039551106,
  4910039551007,
  4910039550901,
  4910039550802,
  4910039550703,
  4910039550604,
  4910039550505,
  4910039550406,
  4910039550307,
  4910039550208,
  4910039550109,
  4910033891147,
  4910033891048,
  4910033890942,
  4910033890843,
  4910033890744,
  4910033890645,
  4910033890546,
  4910033890447,
  4910033890348,
  4910033890249,
  4910033890140,
  4910033891239,
  4910033891130,
  4910033891031,
  4910033890935,
  4910033890836,
  4910033890737,
  4910033890639,
  4910033890539,
  4910033890430,
  4910033890331,
  4910033890232,
  4910033890133,
  4910033891222,
  4910033891123,
  4910033891024,
  4910033890928,
  4910033890829,
  4910033890720,
  4910033890621,
  4910033890522,
  4910033890423,
  4910033890324,
  4910033890225,
  4910033890126,
  4910033891215,
  4910033891116,
  4910033891017,
  4910033890911,
  4910033890812,
  4910033890713,
  4910033890614,
  4910033890515,
  4910033890416,
  4910033890317,
  4910033890218,
  4910033890119,
  4910033891208,
  4910033891109,
  4910033891000,
  4910033890904,
  4910033890805,
  4910033890706,
  4910033890607,
  4910033890508,
  4910033890409,
  4910033890300,
  4910033890201,
  4910033890102,
);

// $publisher_id = 24; // 吉川弘文館 pro stg
// $publisher_id = 86; // 学陽書房 pro stg
// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1165; // 世界文化社 pro
$publisher_id = 1210; // 国際商業出版 stg

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
  $sql = "select id,name,jan_code,case ebook_status when true then '1' else '0' end as ebook_status from books where publisher_id = {$publisher_id} and jan_code = '{$v}' order by ebook_status;";
  foreach ($db->query($sql) as $row) {
    // echo $row['isbn'];
    // echo "||"; // 後で置換用の区切り文字
    echo $row['jan_code'];
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
