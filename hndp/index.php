<?php
require_once('../tools.php');

$isbnlist = array(
  // 9784642734738,
  // 9784642732901,
  // 9784642733595,
  // 9784642733885,
  // 9784642733960,
  // 9784642734097,
  // 9784642734325,
  // 9784642734417,
  // 9784642734424,
  // 9784642734448,
  // 9784642738200,
  // 9784642734707,
  // 9784642729215,
  // 9784642736664,
  // 9784642736848,
  // 9784642737579,
  // 9784642737678,
  // 9784642737708,
  // 9784642737791,
  // 9784642737821,
  // 9784642738088,
  // 9784642738095,
  // 9784642714075,
  // 9784642734592,
  // 9784642727563,
  // 9784642720182,
  // 9784642723091,
  // 9784642723497,
  // 9784642723718,
  // 9784642723763,
  // 9784642723879,
  // 9784642723961,
  // 9784642724609,
  // 9784642724685,
  // 9784642724838,
  // 9784642729437,
  // 9784642724869,
  // 9784642729277,
  // 9784642728430,
  // 9784642728454,
  // 9784642728539,
  // 9784642728645,
  // 9784642728799,
  // 9784642728829,
  // 9784642728843,
  // 9784642729031,
  // 9784642729130,
  // 9784642738224,
  // 9784642724845,
  // 9784642738569,
  // 9784642746120,
  // 9784642746182,
  // 9784642746205,
  // 9784642746274,
  // 9784642746328,
  // 9784642746335,
  // 9784642746359,
  // 9784642773607,
  // 9784642773614,
  // 9784642782005,
  // 9784642773638,
  // 9784642738163,

  9784642752244,
  9784642751605,
  9784642751612,
  9784642751629,
  9784642751711,
  9784642751841,
  9784642751865,
  9784642751926,
  9784642752084,
  9784642752183,
  9784642752220,
  9784642751087,
  9784642752282,
  9784642752343,
  9784642752510,
  9784642752534,
  9784642752541,
  9784642752565,
  9784642752596,
  9784642752640,
  9784642752664,
  9784642752688,
  9784642752213,
  9784642750103,
  9784642751568,
  9784642751360,
  9784642750165,
  9784642750264,
  9784642750288,
  9784642750509,
  9784642750585,
  9784642750592,
  9784642750745,
  9784642750820,
  9784642751063,
  9784642752770,

);

$publisher_id = 24; // 吉川弘文館 pro stg
// $publisher_id = 86; // 学陽書房 pro stg
// $publisher_id = 1125; // 竹書房 pro

/**
* 環境
*/
// $env = 'pro';
// $env = 'stg';
$env = 'docker';

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
