<?php
require_once('../tools.php');
tools::loadEnv();

/**
 *
 * アクセスURL
 * http://localhost:8081/setbookrelates/
 *
 * 関連書誌を相互に紐づける
 * 書誌の存在チェック、すでに紐づいているものはスキップする
 *
 * 事前に関連書誌のデータをチェックしておく
 *
 * select br.* from book_relates as br
 * left join books as b on br.book_id = b.id
 * where b.publisher_id = 1163;
 *
 */

$datalist = array(
  array(10161519 => array(10161522)),
  array(10161518 => array(10161643)),
  array(10161518 => array(10161593)),
  array(10161518 => array(10161588)),
  array(10161518 => array(10161553)),
  array(10164757 => array(10163165)),
);
// ↑ キー 主書誌、array サブ書誌
// 同じキーで複数行記述する場合を想定し、1行ごとにarrayで囲むように変更
// 例）
// array( 10123997 => array(10123994)),
// array( 10123997 => array(10123996)),
// array( 10123997 => array(10123998)),
// array( 10123998 => array(10123995,10123996,10123997,10123999)),
// array( 10123999 => array(10123996)),
// array( 10123999 => array(10123998)),

/**
 * 環境
 */
$env = 'pro';
// $env = 'stg';
// $env = 'docker';

$publisher_id = PUBLISHER_IDS['慶應義塾大学出版会'][$env];

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));


$datacount = count($datalist);

ob_start();

foreach ($datalist as $kk => $vv) {
  reset($vv);

  $k = key($vv);
  $v = current($vv);

  // 書誌の存在チェック
  $sql = "select id from books where id = '{$k}' and publisher_id = {$publisher_id};";
  $sth = $db->query($sql);
  $mainbook = $sth->fetch(PDO::FETCH_ASSOC);
  if (empty($mainbook)) {
    // 書誌データがない場合は スキップ
    echo "!! not main book data id {$k}<br>";
    flush();
    ob_flush();
    continue;
  }

  foreach ($v as $k2 => $v2) {
    // 書誌の存在チェック
    $sql = "select id from books where id = '{$v2}' and publisher_id = {$publisher_id};";
    $sth = $db->query($sql);
    $subbook = $sth->fetch(PDO::FETCH_ASSOC);
    if (empty($subbook)) {
      // 書誌データがない場合は スキップ
      echo "!! not sub book data id {$k} > {$v2}<br>";
      flush();
      ob_flush();
      continue;
    }

    // main > sub の関連書籍レコードの存在チェック
    $sql = "select id from book_relates where book_id = '{$k}' and book_relate_book_id = {$v2};";
    $sth = $db->query($sql);
    $check = $sth->fetch(PDO::FETCH_ASSOC);
    if (empty($check)) {
      // 並び順を取得
      $order = 1;
      $sql = "select max(display_order) as maxorder from book_relates where book_id = '{$k}';";
      $sth = $db->query($sql);
      $max = $sth->fetch(PDO::FETCH_ASSOC);
      if (!empty($max)) {
        $order = intval($max['maxorder']) + 1;
      }

      // main > sub の関連書籍レコード 追加
      $sql = "insert into book_relates (book_id,book_relate_book_id,display_order,created_at,updated_at) values ({$k},{$v2},{$order},now(),now());";
      if ($db->exec($sql) !== false) {
        echo "success id {$k} > {$v2}<br>";
      } else {
        echo "!! add book_relate error id {$k} > {$v2}<br>";
      }
    } else {
      // 存在する場合は処理しない
      echo "!! exist book_relate id {$k} > {$v2}<br>";
    }

    // main < sub の関連書籍レコードの存在チェック
    $sql = "select id from book_relates where book_id = '{$v2}' and book_relate_book_id = {$k};";
    $sth = $db->query($sql);
    $check = $sth->fetch(PDO::FETCH_ASSOC);
    if (empty($check)) {
      // 並び順を取得
      $order = 1;
      $sql = "select max(display_order) as maxorder from book_relates where book_id = '{$v2}';";
      $sth = $db->query($sql);
      $max = $sth->fetch(PDO::FETCH_ASSOC);
      if (!empty($max)) {
        $order = intval($max['maxorder']) + 1;
      }

      // main < sub の関連書籍レコード 追加
      $sql = "insert into book_relates (book_id,book_relate_book_id,display_order,created_at,updated_at) values ({$v2},{$k},{$order},now(),now())";
      if ($db->exec($sql) !== false) {
        echo "success id {$k} < {$v2}<br>";
      } else {
        echo "!! add book_relate error id {$k} < {$v2}<br>";
      }
    } else {
      // 存在する場合は処理しない
      echo "!! exist book_relate id {$k} < {$v2}<br>";
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
