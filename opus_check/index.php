<?php
require_once('../tools.php');
tools::loadEnv();

// 書誌＋著者名リストを元に
// 該当するopusesを検索し、id、author_id,author_name,author_profile を返す
// 検索する著者名に該当する著者が複数あった場合は、最初にヒットした著者で処理するため、
// 実際は登録されているopusesレコードがあるのに、値を返さない場合がある
// 値が返らなかった場合は、未登録だけでなく、著者が複数ヒットしたことによるミスマッチの場合があるため、
// 値が帰らなかった場合は注意する必要あり

$datalist = array(
  array('id' => 10137424, 'data' => array('池見　酉次郎')),
  array('id' => 10137425, 'data' => array('河合　隼雄')),
);

// ↑↑↑↑↑
// array(
//   "id" => BookID,
//   "data" => array(
//     "著者名1",
//     "著者名2",
//     "著者名3",
//     "著者名4",
//     "著者名5",
//   )
// ),

/**
 * 環境
 */
require_once('../config.php');

// $env = 'pro';
$env = 'stg';
// $env = 'docker';

$publisher_id = PUBLISHER_IDS['創元社'][$env];

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));


$datacount = count($datalist);

ob_start();

$i = 0;
foreach ($datalist as $k => $v) {
  echo "{$v['id']}||";
  foreach ($v["data"] as $k2 => $v2) {
    // 著者の存在チェック
    // → 著者名の完全一致で対応してみる
    $sql = "select id from authors where name = '{$v2}' and publisher_id = {$publisher_id};";
    $sth = $db->query($sql);
    $author = $sth->fetch(PDO::FETCH_ASSOC);
    if (empty($author)) {
      // 著者データがない場合は スキップ
      // echo "not author data id {$v['id']} - '{$v2}'<br>";
      echo "||||";
      flush();
      ob_flush();
      continue;
    }

    // 著作レコードの存在チェック
    $sql = "select * from opuses where book_id = {$v['id']} and author_id = {$author['id']};";
    $sth = $db->query($sql);
    $opus = $sth->fetch(PDO::FETCH_ASSOC);
    if (empty($opus)) {
      // 著作レコードがない場合は スキップ
      // echo "not opus data id {$v['id']} - '{$v2}'<br>";
      echo "||||";
      flush();
      ob_flush();
      continue;
    }

    // 著作レコードの情報出力
    // opusid||プロフィールあり1なし0||
    $profile = 0;
    if (!empty($opus['author_profile'])) {
      $profile = 1;
    }
    echo "{$opus['id']}||{$profile}||";
    flush();
    ob_flush();
  }

  $i++;

  echo " // " . $i . " / " . $datacount . "<br>";
  flush();
  ob_flush();
}
flush();
ob_flush();

ob_end_flush();

echo "end!!";
exit();
