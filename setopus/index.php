<?php
require_once('../tools.php');
tools::loadEnv();

// S:\マイドライブ\hondana\sekaibunka_世界文化社\SEKAIBUNKA_DEV-7 書誌データ関連
// のExcelで著者の配列を作った後、下記の正規表現でヒットした行を削除する
// ^.*=> array\(\ \)\, \)\,
//
// array(,array( 'name
// で検索して、
// array(array( 'name
// に置換もする
//
// "array( でも検索して、対応する
$datalist = array(
  array('id' => 10162247, 'opus' => array(array('name' => 'G.シャンツ', 'kana' => 'G.シャンツ', 'type' => '　', 'author_profile' => null,), array('name' => '小島三郎', 'kana' => 'コジマサブロウ', 'type' => '編', 'author_profile' => null,),),),
  array('id' => 10162297, 'opus' => array(array('name' => '中村勝範', 'kana' => '　', 'type' => '編', 'author_profile' => null,),),),
  array('id' => 10162359, 'opus' => array(array('name' => '周暁燕', 'kana' => '　', 'type' => '著', 'author_profile' => null,),),),
  array('id' => 10162459, 'opus' => array(array('name' => '苗村憲司', 'kana' => 'ナエムラケンジ', 'type' => '編著', 'author_profile' => null,), array('name' => '小宮山宏之', 'kana' => 'コミヤマヒロユキ', 'type' => '　', 'author_profile' => null,),),),
);

// ↑↑↑↑↑
// array(
//   'id' => "***",
//   'opus' => array(
//     array(
//       'name' => '***',
//       'kana' => '***',
//       'type' => '***',
//       'author_profile' => "***",
//     ),
//     ～～～
//     ～～～
//   ),
// ),
// ～～～
// ～～～
// author_profile に設定する値は " を \"に置換した上で設定する
// 処理途中で ' を ''、\" を " にする処理を入れる

/**
 * 環境
 */
require_once('../config.php');

// $env = 'pro';
$env = 'stg';
// $env = 'docker';

$publisher_id = PUBLISHER_IDS['慶應義塾大学出版会'][$env];

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));


$datacount = count($datalist);

ob_start();

$type_list = array(
  "著" => array('id' => 1, 'role' => 'A01'),
  "訳" => array('id' => 2, 'role' => 'B06'),
  "作" => array('id' => 3, 'role' => 'A01'),
  "原作" => array('id' => 4, 'role' => 'A10'),
  "原案" => array('id' => 5, 'role' => 'A10'),
  "編" => array('id' => 6, 'role' => 'B01'),
  "編著" => array('id' => 7, 'role' => 'B01'),
  "編訳" => array('id' => 8, 'role' => 'B01'),
  "編注" => array('id' => 9, 'role' => 'B01'),
  "監" => array('id' => 10, 'role' => 'B20'),
  "監訳" => array('id' => 11, 'role' => 'B20'),
  "文" => array('id' => 12, 'role' => 'A01'),
  "絵" => array('id' => 13, 'role' => 'A12'),
  "画" => array('id' => 14, 'role' => 'A12'),
  "写真" => array('id' => 15, 'role' => 'A08'),
  "脚本" => array('id' => 17, 'role' => 'A03'),
  "作曲" => array('id' => 18, 'role' => 'A06'),
  "イラスト" => array('id' => 19, 'role' => 'A12'),
  "解説" => array('id' => 20, 'role' => 'A21'),
  "朗読" => array('id' => 21, 'role' => 'E07'),
);

$i = 0;
$roop = 0;
foreach ($datalist as $k => $v) {
  // 書誌の存在チェック
  $sql = "select id from books where id = '{$v['id']}' and publisher_id = {$publisher_id};";
  $sth = $db->query($sql);
  $book = $sth->fetch(PDO::FETCH_ASSOC);
  if (empty($book)) {
    // 書誌データがない場合は スキップ
    echo "not book data id {$v['id']}<br>";
    flush();
    ob_flush();
    continue;
  }

  foreach ($v['opus'] as $k1 => $v1) {
    // 前後の空白削除
    $v1['name'] = trim($v1['name']);
    $v1['type'] = trim($v1['type']);
    if (empty($v1['name']) || empty($v1['type'])) {
      // 空の値がある場合は スキップ
      echo "empty data exists bookid {$v['id']} author " . ($k1 + 1) . "<br>";
      flush();
      ob_flush();
      continue;
    }
    // 半角カタカナ、ひらがなは、全角カタカナへ変換
    $v1['kana'] = trim(mb_convert_kana($v1['kana'], "KC"));
    // カタカナ以外を削除
    $v1['kana'] = mb_ereg_replace('[^ァ-ヶー]', '', $v1['kana']);
    if (empty($v1['kana'])) {
      // 空の場合は半角スペースを設定
      $v1['kana'] = ' ';
    }

    // authorをチェック
    $sql = "select * from authors where publisher_id = {$publisher_id} and name = '{$v1['name']}' and kana = '{$v1['kana']}';";
    $sth = $db->query($sql);
    $author = $sth->fetch(PDO::FETCH_ASSOC);

    if (empty($author)) {
      // 著者の登録が必要

      // 検索用カラムの対応
      $name_search = tools::convertSearchText($v1['name']);
      $namekana_search = tools::convertSearchText($v1['name'] . $v1['kana']);

      $isql = "insert into authors (name,kana,publisher_id,name_search,namekana_search,created_at,updated_at) values ('{$v1['name']}','{$v1['kana']}',{$publisher_id},'{$name_search}','{$namekana_search}',now(),now());";

      if ($db->exec($isql) === false) {
        echo "not insert author skip book id {$v['id']} author " . ($k1 + 1) . "{$isql}<br>";
        flush();
        ob_flush();
        continue;
      }
      // 再取得
      $sth = $db->query($sql);
      $author = $sth->fetch(PDO::FETCH_ASSOC);
      if (empty($author)) {
        echo "not get insert author skip book id {$v['id']} author " . ($k1 + 1) . "<br>";
        flush();
        ob_flush();
        continue;
      }
    }

    // opusesをチェック
    $sql = "select * from opuses where book_id = {$v['id']} and author_id = {$author['id']};";
    $sth = $db->query($sql);
    $opus = $sth->fetch(PDO::FETCH_ASSOC);
    if (empty($opus)) {
      // 著者タイプの確認
      $type_id = 16; // その他
      $type_other = "null";
      $role = "A01"; // 著
      if (array_key_exists($v1['type'], $type_list)) {
        $type_id = $type_list[$v1['type']]['id'];
        $role = $type_list[$v1['type']]['role'];
      } else {
        // その他の著者タイプを指定
        $type_other = "'{$v1['type']}'";
      }

      $isql = '';
      if (empty($v1['author_profile'])) {
        // 著者プロフィールなし
        $isql = "insert into opuses (book_id,author_id,author_type,author_type_other,contributor_role,created_at,updated_at) values ({$v['id']},{$author['id']},{$type_id},{$type_other},'{$role}',now(),now());";
      } else {
        // 著者プロフィールあり

        // ' のエスケープ
        $v1['author_profile'] = str_replace("'", "''", $v1['author_profile']);
        $v1['author_profile'] = str_replace('\"', '"', $v1['author_profile']);
        $isql = "insert into opuses (book_id,author_id,author_type,author_type_other,contributor_role,author_profile,created_at,updated_at) values ({$v['id']},{$author['id']},{$type_id},{$type_other},'{$role}','{$v1['author_profile']}',now(),now());";
      }
      if ($db->exec($isql) === false) {
        echo "not insert author skip book id {$v['id']} author " . ($k1 + 1) . "<br>";
        flush();
        ob_flush();
        continue;
      }
    } else {
      // すでにopusesレコードがある
      echo "opuses data is existing. book id {$v['id']} author " . ($k1 + 1) . "<br>";
      flush();
      ob_flush();
    }
  }

  $i++;
  $roop++;
  // if($i > 20) {
  // 20回まわったら ページ出力
  echo $roop . " / " . $datacount . " id:" . $v['id'] . "<br>";
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
