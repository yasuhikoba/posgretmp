<?php
require_once('../tools.php');

$datalist = array(
  array('mainid' => 10095955,'maintype' => '雑誌','subid' => 10093201,'subtype' => '電子書籍'),
  array('mainid' => 10095956,'maintype' => '雑誌','subid' => 10093202,'subtype' => '電子書籍'),
  array('mainid' => 10095957,'maintype' => '雑誌','subid' => 10093203,'subtype' => '電子書籍'),
  array('mainid' => 10095958,'maintype' => '雑誌','subid' => 10093204,'subtype' => '電子書籍'),
  array('mainid' => 10095959,'maintype' => '雑誌','subid' => 10093205,'subtype' => '電子書籍'),
  array('mainid' => 10095960,'maintype' => '雑誌','subid' => 10093206,'subtype' => '電子書籍'),
  array('mainid' => 10095961,'maintype' => '雑誌','subid' => 10093207,'subtype' => '電子書籍'),
  array('mainid' => 10095962,'maintype' => '雑誌','subid' => 10093208,'subtype' => '電子書籍'),
  array('mainid' => 10095963,'maintype' => '雑誌','subid' => 10093209,'subtype' => '電子書籍'),
  array('mainid' => 10095964,'maintype' => '雑誌','subid' => 10093210,'subtype' => '電子書籍'),
  array('mainid' => 10095965,'maintype' => '雑誌','subid' => 10093211,'subtype' => '電子書籍'),
  array('mainid' => 10095966,'maintype' => '雑誌','subid' => 10093212,'subtype' => '電子書籍'),
  array('mainid' => 10095967,'maintype' => '雑誌','subid' => 10093213,'subtype' => '電子書籍'),
  array('mainid' => 10095968,'maintype' => '雑誌','subid' => 10093214,'subtype' => '電子書籍'),
  array('mainid' => 10095969,'maintype' => '雑誌','subid' => 10093215,'subtype' => '電子書籍'),
  array('mainid' => 10095970,'maintype' => '雑誌','subid' => 10093216,'subtype' => '電子書籍'),
  array('mainid' => 10095971,'maintype' => '雑誌','subid' => 10093217,'subtype' => '電子書籍'),
  array('mainid' => 10095972,'maintype' => '雑誌','subid' => 10093218,'subtype' => '電子書籍'),
  array('mainid' => 10095973,'maintype' => '雑誌','subid' => 10093219,'subtype' => '電子書籍'),
  array('mainid' => 10095974,'maintype' => '雑誌','subid' => 10093220,'subtype' => '電子書籍'),
  array('mainid' => 10095975,'maintype' => '雑誌','subid' => 10093221,'subtype' => '電子書籍'),
  array('mainid' => 10095976,'maintype' => '雑誌','subid' => 10093222,'subtype' => '電子書籍'),
  array('mainid' => 10095977,'maintype' => '雑誌','subid' => 10093223,'subtype' => '電子書籍'),
  array('mainid' => 10095978,'maintype' => '雑誌','subid' => 10093224,'subtype' => '電子書籍'),
  array('mainid' => 10095979,'maintype' => '雑誌','subid' => 10093225,'subtype' => '電子書籍'),
  array('mainid' => 10095980,'maintype' => '雑誌','subid' => 10093226,'subtype' => '電子書籍'),
  array('mainid' => 10095981,'maintype' => '雑誌','subid' => 10093227,'subtype' => '電子書籍'),
  array('mainid' => 10095982,'maintype' => '雑誌','subid' => 10093228,'subtype' => '電子書籍'),
  array('mainid' => 10095983,'maintype' => '雑誌','subid' => 10093229,'subtype' => '電子書籍'),
  array('mainid' => 10095984,'maintype' => '雑誌','subid' => 10093230,'subtype' => '電子書籍'),
  array('mainid' => 10095985,'maintype' => '雑誌','subid' => 10093231,'subtype' => '電子書籍'),
  array('mainid' => 10095986,'maintype' => '雑誌','subid' => 10093232,'subtype' => '電子書籍'),
  array('mainid' => 10095987,'maintype' => '雑誌','subid' => 10093233,'subtype' => '電子書籍'),
  array('mainid' => 10095988,'maintype' => '雑誌','subid' => 10093234,'subtype' => '電子書籍'),
  array('mainid' => 10095989,'maintype' => '雑誌','subid' => 10093235,'subtype' => '電子書籍'),
  array('mainid' => 10095990,'maintype' => '雑誌','subid' => 10093236,'subtype' => '電子書籍'),
  array('mainid' => 10095991,'maintype' => '雑誌','subid' => 10093237,'subtype' => '電子書籍'),
  array('mainid' => 10095992,'maintype' => '雑誌','subid' => 10093238,'subtype' => '電子書籍'),
  array('mainid' => 10095993,'maintype' => '雑誌','subid' => 10093239,'subtype' => '電子書籍'),
  array('mainid' => 10095994,'maintype' => '雑誌','subid' => 10093240,'subtype' => '電子書籍'),
  array('mainid' => 10095995,'maintype' => '雑誌','subid' => 10093241,'subtype' => '電子書籍'),
  array('mainid' => 10095996,'maintype' => '雑誌','subid' => 10093242,'subtype' => '電子書籍'),
  array('mainid' => 10095997,'maintype' => '雑誌','subid' => 10093243,'subtype' => '電子書籍'),
  array('mainid' => 10095998,'maintype' => '雑誌','subid' => 10093244,'subtype' => '電子書籍'),
  array('mainid' => 10095999,'maintype' => '雑誌','subid' => 10093245,'subtype' => '電子書籍'),
  array('mainid' => 10096000,'maintype' => '雑誌','subid' => 10093246,'subtype' => '電子書籍'),
  array('mainid' => 10096001,'maintype' => '雑誌','subid' => 10093247,'subtype' => '電子書籍'),
  array('mainid' => 10096002,'maintype' => '雑誌','subid' => 10093248,'subtype' => '電子書籍'),
  array('mainid' => 10096003,'maintype' => '雑誌','subid' => 10093249,'subtype' => '電子書籍'),
  array('mainid' => 10096004,'maintype' => '雑誌','subid' => 10093250,'subtype' => '電子書籍'),
  array('mainid' => 10096005,'maintype' => '雑誌','subid' => 10093251,'subtype' => '電子書籍'),
  array('mainid' => 10096006,'maintype' => '雑誌','subid' => 10093252,'subtype' => '電子書籍'),
  array('mainid' => 10096007,'maintype' => '雑誌','subid' => 10093253,'subtype' => '電子書籍'),
  array('mainid' => 10096008,'maintype' => '雑誌','subid' => 10093254,'subtype' => '電子書籍'),
  array('mainid' => 10096009,'maintype' => '雑誌','subid' => 10093255,'subtype' => '電子書籍'),
  array('mainid' => 10096010,'maintype' => '雑誌','subid' => 10093256,'subtype' => '電子書籍'),
  array('mainid' => 10096011,'maintype' => '雑誌','subid' => 10093257,'subtype' => '電子書籍'),
  array('mainid' => 10096012,'maintype' => '雑誌','subid' => 10093258,'subtype' => '電子書籍'),
  array('mainid' => 10096013,'maintype' => '雑誌','subid' => 10093259,'subtype' => '電子書籍'),
  array('mainid' => 10096014,'maintype' => '雑誌','subid' => 10093260,'subtype' => '電子書籍'),
  array('mainid' => 10096015,'maintype' => '雑誌','subid' => 10093261,'subtype' => '電子書籍'),
  array('mainid' => 10096016,'maintype' => '雑誌','subid' => 10093262,'subtype' => '電子書籍'),
  array('mainid' => 10096017,'maintype' => '雑誌','subid' => 10093263,'subtype' => '電子書籍'),
  array('mainid' => 10096018,'maintype' => '雑誌','subid' => 10093264,'subtype' => '電子書籍'),
  array('mainid' => 10096019,'maintype' => '雑誌','subid' => 10093265,'subtype' => '電子書籍'),
  array('mainid' => 10096020,'maintype' => '雑誌','subid' => 10093266,'subtype' => '電子書籍'),
  array('mainid' => 10096021,'maintype' => '雑誌','subid' => 10093267,'subtype' => '電子書籍'),
  array('mainid' => 10096022,'maintype' => '雑誌','subid' => 10093268,'subtype' => '電子書籍'),
  array('mainid' => 10096023,'maintype' => '雑誌','subid' => 10093269,'subtype' => '電子書籍'),
  array('mainid' => 10096024,'maintype' => '雑誌','subid' => 10093270,'subtype' => '電子書籍'),
  array('mainid' => 10096025,'maintype' => '雑誌','subid' => 10093271,'subtype' => '電子書籍'),
  array('mainid' => 10096026,'maintype' => '雑誌','subid' => 10093272,'subtype' => '電子書籍'),
  array('mainid' => 10096027,'maintype' => '雑誌','subid' => 10093273,'subtype' => '電子書籍'),
  array('mainid' => 10096028,'maintype' => '雑誌','subid' => 10093274,'subtype' => '電子書籍'),
  array('mainid' => 10096029,'maintype' => '雑誌','subid' => 10093275,'subtype' => '電子書籍'),
  array('mainid' => 10096030,'maintype' => '雑誌','subid' => 10093276,'subtype' => '電子書籍'),
  array('mainid' => 10096031,'maintype' => '雑誌','subid' => 10093277,'subtype' => '電子書籍'),
  array('mainid' => 10096032,'maintype' => '雑誌','subid' => 10093278,'subtype' => '電子書籍'),
  array('mainid' => 10096033,'maintype' => '雑誌','subid' => 10093279,'subtype' => '電子書籍'),
  array('mainid' => 10096034,'maintype' => '雑誌','subid' => 10093280,'subtype' => '電子書籍'),
  array('mainid' => 10096035,'maintype' => '雑誌','subid' => 10093281,'subtype' => '電子書籍'),
  array('mainid' => 10096036,'maintype' => '雑誌','subid' => 10093282,'subtype' => '電子書籍'),
  array('mainid' => 10096037,'maintype' => '雑誌','subid' => 10093283,'subtype' => '電子書籍'),
  array('mainid' => 10096038,'maintype' => '雑誌','subid' => 10093284,'subtype' => '電子書籍'),
  array('mainid' => 10096039,'maintype' => '雑誌','subid' => 10093285,'subtype' => '電子書籍'),
  array('mainid' => 10096040,'maintype' => '雑誌','subid' => 10093286,'subtype' => '電子書籍'),
  array('mainid' => 10096041,'maintype' => '雑誌','subid' => 10093287,'subtype' => '電子書籍'),
  array('mainid' => 10096042,'maintype' => '雑誌','subid' => 10093288,'subtype' => '電子書籍'),
  array('mainid' => 10096043,'maintype' => '雑誌','subid' => 10093289,'subtype' => '電子書籍'),
  array('mainid' => 10096044,'maintype' => '雑誌','subid' => 10093290,'subtype' => '電子書籍'),
  array('mainid' => 10096045,'maintype' => '雑誌','subid' => 10093291,'subtype' => '電子書籍'),
  array('mainid' => 10096046,'maintype' => '雑誌','subid' => 10093292,'subtype' => '電子書籍'),
  array('mainid' => 10096047,'maintype' => '雑誌','subid' => 10093293,'subtype' => '電子書籍'),
  array('mainid' => 10096048,'maintype' => '雑誌','subid' => 10093294,'subtype' => '電子書籍'),
  array('mainid' => 10096049,'maintype' => '雑誌','subid' => 10093295,'subtype' => '電子書籍'),
  array('mainid' => 10096050,'maintype' => '雑誌','subid' => 10093296,'subtype' => '電子書籍'),
  array('mainid' => 10096051,'maintype' => '雑誌','subid' => 10093297,'subtype' => '電子書籍'),
  array('mainid' => 10096052,'maintype' => '雑誌','subid' => 10093298,'subtype' => '電子書籍'),
  array('mainid' => 10096053,'maintype' => '雑誌','subid' => 10093299,'subtype' => '電子書籍'),
  array('mainid' => 10096054,'maintype' => '雑誌','subid' => 10093300,'subtype' => '電子書籍'),
  array('mainid' => 10096055,'maintype' => '雑誌','subid' => 10093301,'subtype' => '電子書籍'),
  array('mainid' => 10096056,'maintype' => '雑誌','subid' => 10093302,'subtype' => '電子書籍'),
  array('mainid' => 10096057,'maintype' => '雑誌','subid' => 10093303,'subtype' => '電子書籍'),
  array('mainid' => 10096058,'maintype' => '雑誌','subid' => 10093304,'subtype' => '電子書籍'),
  array('mainid' => 10096059,'maintype' => '雑誌','subid' => 10093305,'subtype' => '電子書籍'),
  array('mainid' => 10096060,'maintype' => '雑誌','subid' => 10093306,'subtype' => '電子書籍'),
  array('mainid' => 10096061,'maintype' => '雑誌','subid' => 10093307,'subtype' => '電子書籍'),
  array('mainid' => 10096062,'maintype' => '雑誌','subid' => 10093308,'subtype' => '電子書籍'),
  array('mainid' => 10096063,'maintype' => '雑誌','subid' => 10093309,'subtype' => '電子書籍'),
  array('mainid' => 10096064,'maintype' => '雑誌','subid' => 10093310,'subtype' => '電子書籍'),
  array('mainid' => 10096065,'maintype' => '雑誌','subid' => 10093311,'subtype' => '電子書籍'),
  array('mainid' => 10096066,'maintype' => '雑誌','subid' => 10093312,'subtype' => '電子書籍'),
  array('mainid' => 10096067,'maintype' => '雑誌','subid' => 10093313,'subtype' => '電子書籍'),
  array('mainid' => 10096068,'maintype' => '雑誌','subid' => 10093314,'subtype' => '電子書籍'),
  array('mainid' => 10096069,'maintype' => '雑誌','subid' => 10093315,'subtype' => '電子書籍'),
  array('mainid' => 10096070,'maintype' => '雑誌','subid' => 10093316,'subtype' => '電子書籍'),
  array('mainid' => 10096071,'maintype' => '雑誌','subid' => 10093317,'subtype' => '電子書籍'),
  array('mainid' => 10096072,'maintype' => '雑誌','subid' => 10093318,'subtype' => '電子書籍'),
);

// ↑ メインフォーマット bookID,メインフォーマットタイプ,サブフォーマット bookID,サブフォーマットタイプ
//   array('mainid' => 10082103,'maintype' => '単行本','subid' => 635230,'subtype' => '電子書籍'),


// $publisher_id = 24;
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
    echo "sub book is already formatted id {$v['subid']}<br>";
    continue;
  }

  $format_group_id = 0;
  if(empty($mainbook['format_group_id'])) {
    // メインbookが フォーマット設定されていない場合は
    // format_groups テーブルにレコード追加
    $sql = "insert into format_groups (publisher_id,created_at,updated_at) values ({$publisher_id},now(),now())";
    if($db->exec($sql) === false) {
      echo "add format_groups error main book id {$v['mainid']}<br>";
      continue;
    }

    // 最後に追加したIDを取得する
    // https://minory.org/postgresql-returning.html
    $sql = "SELECT lastval();";
    $sth = $db->query($sql);
    $fg = $sth->fetch(PDO::FETCH_ASSOC);
    if(empty($fg['lastval'])) {
      echo "get last id error main book id {$v['mainid']}<br>";
      continue;
    }
    // format_group_id 設定
    $sql = "update books set format_group_id = {$fg['lastval']},updated_at = now() where id = {$v['mainid']}";
    if($db->exec($sql) === false) {
      echo "format_group_id set error main book id {$v['mainid']}<br>";
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
    echo "main book update error id {$v['mainid']}<br>";
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
    echo "sub book update error id {$v['subid']}<br>";
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
