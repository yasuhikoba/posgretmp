<?php
require_once('../tools.php');
tools::loadEnv();

$list = array(
  array('name' => 'スーパージャーナル　クラシックＢＥＳＴ', 'isbn' => '9784812449974'),
  array('name' => 'まるごと１冊ぼのぼのスペシャル', 'isbn' => '9784801903746'),
  array('name' => 'フリテンくんＰＲＥＭＩＵＭ', 'isbn' => '9784801906006'),
  array('name' => 'フリテンくんＧＯＬＤ', 'isbn' => '9784801908215'),
  array('name' => '劇漫デラックス', 'isbn' => '9784801906044'),
);

/**
 * 環境
 */
require_once('../config.php');

// $env = 'pro';
$env = 'stg';
// $env = 'docker';

$publisher_id = PUBLISHER_IDS['竹書房'][$env];

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));


ob_start();

$i = 0;
foreach ($list as $k => $v) {
  $sql = "";
  if (!empty($v['isbn'])) {
    $sql = "select id,name,isbn,publisher_id from books where isbn = '{$v['isbn']}' and publisher_id = {$publisher_id};";
  } else {
    $sql = "select id,name,isbn,publisher_id from books where name = '{$v['name']}' and publisher_id = {$publisher_id};";
  }
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
  if ($i > 20) {
    // 20回まわったら ページ出力
    flush();
    ob_flush();
    $i = 0;
  }
}
flush();
ob_flush();

ob_end_flush();

echo "end!!";
exit();
