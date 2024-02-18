<?php

$datalist = array(
  array('id' => 10001004,'opus' => array(array( 'name' => '小倉ひろあき', 'kana' => 'オグラヒロアキ', 'type' => '原作', ),array( 'name' => 'Ｎａｇｙ', 'kana' => 'ナギー', 'type' => '作画', ),array( 'name' => 'toi8', 'kana' => '・', 'type' => 'キャラクター原案', ), ), ),
  array('id' => 10001005,'opus' => array(array( 'name' => 'なるせいさ９９９Ａａ', 'kana' => 'ナルセイサ', 'type' => '作画', ),array( 'name' => 'きりんこ', 'kana' => '・', 'type' => '作画', ), ), ),
  array('id' => 10001006,'opus' => array(array( 'name' => '小倉ひろあき', 'kana' => 'オグラヒロアキ', 'type' => '原作', ), ), ),
);

// ↑↑↑↑↑
// array(
//   'id' => "***",
//   'opus' => array(
//     array(
//       'name' => '***',
//       'kana' => '***',
//       'type' => '***',
//     ),
//   ),
// );

$publisher_id = 1125; // 竹書房 pro
$debug = true;

if($debug) {
  // Docker用
  // 先に Postgres側を起動しておかないと IPが認識できず、アクセスできない
  $dsn = 'pgsql:dbname=app_development;host=172.27.114.177;port=15432';
  $db = new PDO($dsn, 'postgres', 'password');
  $publisher_id = 1002; // docker

  // // STG用
  // $dsn = 'pgsql:dbname=d32hupuj29g33c;host=ec2-44-206-11-200.compute-1.amazonaws.com;port=5432';
  // $db = new PDO($dsn, 'rszgmnfrbqlgot', '237cbd5e1db3db80228bbf1483cd208c850e4d22bfd12c85b7e317b1cc569700');
  // $publisher_id = 1040; // 竹書房 stg
} else {
  // // 本番用
  // $dsn = 'pgsql:dbname=d3uldjpkj3ctch;host=ec2-34-233-148-141.compute-1.amazonaws.com;port=5432';
  // $db = new PDO($dsn, 'u43nqlr506q4qg', 'pd20127aa81443c772b163cc2eb6c9960b8735bb9a29528e868c86af98c8ed8ed');
}

$datacount = count($datalist);

ob_start();

$type_list = array(
  "著" => array('id' => 1,'role' => 'A01'),
  "訳" => array('id' => 2,'role' => 'B06'),
  "作" => array('id' => 3,'role' => 'A01'),
  "原作" => array('id' => 4,'role' => 'A10'),
  "原案" => array('id' => 5,'role' => 'A10'),
  "編" => array('id' => 6,'role' => 'B01'),
  "編著" => array('id' => 7,'role' => 'B01'),
  "編訳" => array('id' => 8,'role' => 'B01'),
  "編注" => array('id' => 9,'role' => 'B01'),
  "監" => array('id' => 10,'role' => 'B20'),
  "監訳" => array('id' => 11,'role' => 'B20'),
  "文" => array('id' => 12,'role' => 'A01'),
  "絵" => array('id' => 13,'role' => 'A12'),
  "画" => array('id' => 14,'role' => 'A12'),
  "写真" => array('id' => 15,'role' => 'A08'),
  "脚本" => array('id' => 17,'role' => 'A03'),
  "作曲" => array('id' => 18,'role' => 'A06'),
  "イラスト" => array('id' => 19,'role' => 'A12'),
  "解説" => array('id' => 20,'role' => 'A21'),
  "朗読" => array('id' => 21,'role' => 'E07'),
);

$i = 0;
$roop = 0;
foreach ($datalist as $k => $v) {
  // 書誌の存在チェック
  $sql = "select id from books where id = '{$v['id']}' and publisher_id = {$publisher_id};";
  $sth = $db->query($sql);
  $book = $sth->fetch(PDO::FETCH_ASSOC);
  if(empty($book)) {
    // 書誌データがない場合は スキップ
    echo "not book data id {$v['id']}<br>";
    flush();
    ob_flush();
    continue;
  }

  foreach ($v['opus'] as $k1 => $v1) {
    // 前後の空白削除
    $empty = false;
    foreach ($v1 as $k2 => $v2) {
      $v[$k]['opus'][$k1][$k2] = trim($v2);
      if(empty($v[$k]['opus'][$k1][$k2])) {
        // 空の値がある場合は その著者のひもづきをスキップ
        $empty = true;
        break;
      }
    }
    if($empty) {
      // 空の値がある場合は スキップ
      echo "empty data exists bookid {$v['id']} author " . ($k1+1) . "<br>";
      flush();
      ob_flush();
      continue;
    }

    // authorをチェック
    $sql = "select * from authors where publisher_id = {$publisher_id} and name = '{$v1['name']}' and kana = '{$v1['kana']}';";
    $sth = $db->query($sql);
    $author = $sth->fetch(PDO::FETCH_ASSOC);

    if(empty($author)) {
      // 著者の登録が必要

      // 検索用カラムの対応
      $name_search = convertSearchText($v1['name']);
      $namekana_search = convertSearchText($v1['name'] . $v1['kana']);

      $isql = "insert into authors (name,kana,publisher_id,name_search,namekana_search,created_at,updated_at) values ('{$v1['name']}','{$v1['kana']}',{$publisher_id},'{$name_search}','{$namekana_search}',now(),now());";

      if($db->exec($isql) === false) {
        echo "not insert author skip book id {$v['id']} author " . ($k1+1) . "{$isql}<br>";
        flush();
        ob_flush();
        continue;
      }
      // 再取得
      $sth = $db->query($sql);
      $author = $sth->fetch(PDO::FETCH_ASSOC);
      if(empty($author)) {
        echo "not get insert author skip book id {$v['id']} author " . ($k1+1) . "<br>";
        flush();
        ob_flush();
        continue;
      }
    }

    // opusesをチェック
    $sql = "select * from opuses where book_id = {$v['id']} and author_id = {$author['id']};";
    $sth = $db->query($sql);
    $opus = $sth->fetch(PDO::FETCH_ASSOC);
    if(empty($opus)) {
      // 著者タイプの確認
      $type_id = 16; // その他
      $type_other = "null";
      $role = "A01"; // 著
      if(array_key_exists($v1['type'],$type_list)) {
        $type_id = $type_list[$v1['type']]['id'];
        $role = $type_list[$v1['type']]['role'];
      } else {
        // その他の著者タイプを指定
        $type_other = "'{$v1['type']}'";
      }
      $isql = "insert into opuses (book_id,author_id,author_type,author_type_other,contributor_role,created_at,updated_at) values ({$v['id']},{$author['id']},{$type_id},{$type_other},'{$role}',now(),now());";
      if($db->exec($isql) === false) {
        echo "not insert author skip book id {$v['id']} author " . ($k1+1) . "<br>";
        flush();
        ob_flush();
        continue;
      }
    } else {
      // すでにopusesレコードがある
      echo "opuses data is existing. book id {$v['id']} author " . ($k1+1) . "<br>";
      flush();
      ob_flush();
    }
  }






  $i++;
  $roop++;
  if($i > 20) {
    // 20回まわったら ページ出力
    echo $roop . " / " . $datacount . " line:" . $k . "<br>";
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

/**
 * [convertSearchText]
 * あいまい検索のため、ひらがなはカタカナへ
 * 全角は半角へ、大文字は小文字へ変換
 *
 * @param [String] $search_text [検索文字]
 * @return [String] [変換後文字列]
 */
function convertSearchText($search_text) {
  $result = preg_replace('/あ|ｱ/', 'ア',$search_text);
  $result = preg_replace('/い|ｲ/', 'イ',$result);
  $result = preg_replace('/う|ゔ|ヴ|ｳﾞ|ｳ/', 'ウ',$result);
  $result = preg_replace('/え|ｴ/', 'エ',$result);
  $result = preg_replace('/お|ｵ/', 'オ',$result);

  $result = preg_replace('/か|が|ガ|ｶﾞ|ｶ/', 'カ',$result);
  $result = preg_replace('/き|ぎ|ギ|ｷﾞ|ｷ/', 'キ',$result);
  $result = preg_replace('/く|ぐ|グ|ｸﾞ|ｸ/', 'ク',$result);
  $result = preg_replace('/け|げ|ゲ|ｹﾞ|ｹ/', 'ケ',$result);
  $result = preg_replace('/こ|ご|ゴ|ｺﾞ|ｺ/', 'コ',$result);

  $result = preg_replace('/さ|ざ|ザ|ｻﾞ|ｻ/', 'サ',$result);
  $result = preg_replace('/し|じ|ジ|ｼﾞ|ｼ/', 'シ',$result);
  $result = preg_replace('/す|ず|ズ|ｽﾞ|ｽ/', 'ス',$result);
  $result = preg_replace('/せ|ぜ|ゼ|ｾﾞ|ｾ/', 'セ',$result);
  $result = preg_replace('/そ|ぞ|ゾ|ｿﾞ|ｿ/', 'ソ',$result);

  $result = preg_replace('/た|だ|ダ|ﾀﾞ|ﾀ/', 'タ',$result);
  $result = preg_replace('/ち|ぢ|ヂ|ﾁﾞ|ﾁ/', 'チ',$result);
  $result = preg_replace('/つ|づ|ヅ|ﾂﾞ|ﾂ/', 'ツ',$result);
  $result = preg_replace('/て|で|デ|ﾃﾞ|ﾃ/', 'テ',$result);
  $result = preg_replace('/と|ど|ド|ﾄﾞ|ﾄ/', 'ト',$result);

  $result = preg_replace('/な|ﾅ/', 'ナ',$result);
  $result = preg_replace('/に|ﾆ/', 'ニ',$result);
  $result = preg_replace('/ぬ|ﾇ/', 'ヌ',$result);
  $result = preg_replace('/ね|ﾈ/', 'ネ',$result);
  $result = preg_replace('/の|ﾉ/', 'ノ',$result);

  $result = preg_replace('/は|ば|ぱ|バ|パ|ﾊﾞ|ﾊﾟ|ﾊ/', 'ハ',$result);
  $result = preg_replace('/ひ|び|ぴ|ビ|ピ|ﾋﾞ|ﾋﾟ|ﾋ/', 'ヒ',$result);
  $result = preg_replace('/ふ|ぶ|ぷ|ブ|プ|ﾌﾞ|ﾌﾟ|ﾌ/', 'フ',$result);
  $result = preg_replace('/へ|べ|ぺ|ベ|ペ|ﾍﾞ|ﾍﾟ|ﾍ/', 'ヘ',$result);
  $result = preg_replace('/ほ|ぼ|ぽ|ボ|ポ|ﾎﾞ|ﾎﾟ|ﾎ/', 'ホ',$result);

  $result = preg_replace('/ま|ﾏ/', 'マ',$result);
  $result = preg_replace('/み|ﾐ/', 'ミ',$result);
  $result = preg_replace('/む|ﾑ/', 'ム',$result);
  $result = preg_replace('/め|ﾒ/', 'メ',$result);
  $result = preg_replace('/も|ﾓ/', 'モ',$result);

  $result = preg_replace('/や|ﾔ/', 'ヤ',$result);
  $result = preg_replace('/ゆ|ﾕ/', 'ユ',$result);
  $result = preg_replace('/よ|ﾖ/', 'ヨ',$result);

  $result = preg_replace('/ら|ﾗ/', 'ラ',$result);
  $result = preg_replace('/り|ﾘ/', 'リ',$result);
  $result = preg_replace('/る|ﾙ/', 'ル',$result);
  $result = preg_replace('/れ|ﾚ/', 'レ',$result);
  $result = preg_replace('/ろ|ﾛ/', 'ロ',$result);

  $result = preg_replace('/わ|ﾜ/', 'ワ',$result);
  $result = preg_replace('/を|ｦ/', 'ヲ',$result);
  $result = preg_replace('/ん|ﾝ/', 'ン',$result);
  $result = preg_replace('/ぁ|ｬ/', 'ァ',$result);
  $result = preg_replace('/ぃ|ｨ/', 'ィ',$result);
  $result = preg_replace('/ぅ|ｩ/', 'ゥ',$result);
  $result = preg_replace('/ぇ|ｪ/', 'ェ',$result);
  $result = preg_replace('/ぉ|ｫ/', 'ォ',$result);
  $result = preg_replace('/っ|ｯ/', 'ッ',$result);
  $result = preg_replace('/ゃ|ｬ/', 'ャ',$result);
  $result = preg_replace('/ゅ|ｭ/', 'ュ',$result);
  $result = preg_replace('/ょ|ｮ/', 'ョ',$result);

  $result = preg_replace('/｡|｢|｣|､|･|ｰ|－|。|「|」|、|・|ー|-|　| |・|:|：/', '',$result);

  $result = mb_convert_kana($result, "rn");
  $result = strtolower($result);

  return $result;
}

?>