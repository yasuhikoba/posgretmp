<?php
require_once('../tools.php');

$datalist = array(
  array('mainid' => 10123211,'maintype' => '単行本','subid' => 10123380,'subtype' => '電子書籍'),
  array('mainid' => 10123386,'maintype' => '単行本','subid' => 10121639,'subtype' => '電子書籍'),
  array('mainid' => 10123099,'maintype' => '単行本','subid' => 10123391,'subtype' => '電子書籍'),
);

// ↑ メインフォーマット bookID,メインフォーマットタイプ,サブフォーマット bookID,サブフォーマットタイプ
//   array('mainid' => 10082103,'maintype' => '単行本','subid' => 635230,'subtype' => '電子書籍'),


// $publisher_id = 24;
// $publisher_id = 86; // 学陽書房 pro stg
// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1165; // 世界文化社 pro
// $publisher_id = 1210; // 国際商業出版 stg
// $publisher_id = 1276; // 丸善出版 stg
$publisher_id = 1203; // 丸善出版 pro

/**
* 環境
*/
// $env = 'pro';
// $env = 'stg';
$env = 'docker';

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

$datacount = count($datalist);

ob_start();

$format_type_list = array(
  "単行本" => 1,
  "文庫" => 2,
  "新書" => 3,
  "コミック" => 4,
  "電子書籍" => 5,
  // other => 6,
);
$i = 0;
$roop = 0;
foreach ($datalist as $k => $v) {
  // 前後の空白削除
  $empty = false;
  foreach ($v as $k1 => $v1) {
    $v[$k1] = trim($v1);
    if(empty($v[$k1])) {
      // 空の値がある場合は スキップ
      $empty = true;
      break;
    }
  }
  if($empty) {
    // 空の値がある場合は スキップ
    echo "empty data exists id {$v['mainid']}<br>";
    continue;
  }

  // 書誌の存在チェック
  $sql = "select id,format_group_id,format_primary,book_format,book_format_other from books where id = '{$v['mainid']}' and publisher_id = {$publisher_id};";
  $sth = $db->query($sql);
  $mainbook = $sth->fetch(PDO::FETCH_ASSOC);
  if(empty($mainbook)) {
    // 書誌データがない場合は スキップ
    echo "not main book data id {$v['mainid']}<br>";
    continue;
  }

  $sql = "select id,format_group_id,format_primary,book_format,book_format_other from books where id = '{$v['subid']}' and publisher_id = {$publisher_id};";
  $sth = $db->query($sql);
  $subbook = $sth->fetch(PDO::FETCH_ASSOC);
  if(empty($subbook)) {
    // 書誌データがない場合は スキップ
    echo "not sub book data id {$v['subid']}<br>";
    continue;
  }

  // サブbookがフォーマット設定されていないことを確認
  if(!empty($subbook['format_group_id'])) {
    echo "!! sub book is already formatted id {$v['mainid']} > {$v['subid']}<br>";
    continue;
  }

  $format_group_id = 0;
  if(empty($mainbook['format_group_id'])) {
    // メインbookが フォーマット設定されていない場合は
    // format_groups テーブルにレコード追加
    $sql = "insert into format_groups (publisher_id,created_at,updated_at) values ({$publisher_id},now(),now())";
    if($db->exec($sql) === false) {
      echo "!! add format_groups error main book id {$v['mainid']} > {$v['subid']}<br>";
      continue;
    }

    // 最後に追加したIDを取得する
    // https://minory.org/postgresql-returning.html
    $sql = "SELECT lastval();";
    $sth = $db->query($sql);
    $fg = $sth->fetch(PDO::FETCH_ASSOC);
    if(empty($fg['lastval'])) {
      echo "!! get last id error main book id {$v['mainid']} > {$v['subid']}<br>";
      continue;
    }
    // format_group_id 設定
    $sql = "update books set format_group_id = {$fg['lastval']},updated_at = now() where id = {$v['mainid']}";
    if($db->exec($sql) === false) {
      echo "!! format_group_id set error main book id {$v['mainid']} > {$v['subid']}<br>";
      continue;
    }
    $format_group_id = $fg['lastval'];
  } else {
    // main book に既にフォーマットグループが設定されている場合
    $format_group_id = $mainbook['format_group_id'];
  }
  // main bookのフォーマットタイプ 設定
  $maintypeid = 6;
  $maintype_other = 'null';
  if(array_key_exists($v['maintype'],$format_type_list)) {
    // フォーマットタイプIDを設定
    $maintypeid = $format_type_list[$v['maintype']];
  } else {
    // フォーマットタイプ その他を設定
    $maintype_other = "'" . str_replace("'","''",$v['maintype']) . "'";
  }
  $sql = "update books set book_format = {$maintypeid},book_format_other = {$maintype_other},updated_at = now() where id = {$v['mainid']}";
  if($db->exec($sql) === false) {
    echo "!! main book update error id {$v['mainid']} > {$v['subid']}<br>";
    continue;
  }

  // sub book 設定
  $subtypeid = 6;
  $subtype_other = 'null';
  if(array_key_exists($v['subtype'],$format_type_list)) {
    // フォーマットタイプIDを設定
    $subtypeid = $format_type_list[$v['subtype']];
  } else {
    // フォーマットタイプ その他を設定
    $subtype_other = "'" . str_replace("'","''",$v['subtype']) . "'";
  }
  $sql = "update books set book_format = {$subtypeid},book_format_other = {$subtype_other},format_group_id = {$format_group_id},format_primary = false,updated_at = now() where id = {$v['subid']}";
  if($db->exec($sql) === false) {
    echo "!! sub book update error id {$v['mainid']} > {$v['subid']}<br>";
    continue;
  }

  $i++;
  $roop++;
  // if($i > 20) {
    // 20回まわったら ページ出力
    echo $roop . " / " . $datacount . " mainid:" . $v['mainid'] . "<br>";
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
