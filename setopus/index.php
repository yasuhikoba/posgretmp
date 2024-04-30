<?php
require_once('../tools.php');

$datalist = array(
array('id' => 10079464,'opus' => array(array( 'name' => '植田まさし', 'kana' => 'ウエダマサシ', 'type' => '著', ), ), ),
array('id' => 10079542,'opus' => array(array( 'name' => '神仙寺瑛', 'kana' => 'シンセンジアキラ', 'type' => '著', ), ), ),
array('id' => 10079543,'opus' => array(array( 'name' => '東屋めめ', 'kana' => 'ヒガシヤメメ', 'type' => '著', ), ), ),
array('id' => 10079544,'opus' => array(array( 'name' => '樹るう', 'kana' => 'タツキルウ', 'type' => '著', ), ), ),
array('id' => 10079545,'opus' => array(array( 'name' => '師走冬子', 'kana' => 'シワストウコ', 'type' => '著', ), ), ),
array('id' => 10079546,'opus' => array(array( 'name' => 'ひととせはるひ', 'kana' => 'ヒトトセハルヒ', 'type' => '著', ), ), ),
array('id' => 10079547,'opus' => array(array( 'name' => 'S井ミツル', 'kana' => 'エスイミツル', 'type' => '著', ), ), ),
array('id' => 10079548,'opus' => array(array( 'name' => 'あがた愛', 'kana' => 'アガタイト', 'type' => '著', ), ), ),
array('id' => 10079549,'opus' => array(array( 'name' => 'ときしば', 'kana' => 'トキシバ', 'type' => '著', ), ), ),
array('id' => 10079550,'opus' => array(array( 'name' => '緋汰しっぷ', 'kana' => 'シタシップ', 'type' => '著', ), ), ),
array('id' => 10079551,'opus' => array(array( 'name' => '久喜わかめ', 'kana' => 'クキワカメ', 'type' => '著', ), ), ),
array('id' => 10079552,'opus' => array(array( 'name' => '直野儚羅', 'kana' => 'ナオノボウラ', 'type' => '著', ), ), ),
array('id' => 10079553,'opus' => array(array( 'name' => 'アンソロジー', 'kana' => 'アンソロジー', 'type' => '著', ), ), ),
array('id' => 10079554,'opus' => array(array( 'name' => 'ぱんだにあ', 'kana' => 'パンダニア', 'type' => '著', ), ), ),
array('id' => 10079555,'opus' => array(array( 'name' => '中村十', 'kana' => 'ナカムラジュウ', 'type' => '著', ), ), ),
array('id' => 10079556,'opus' => array(array( 'name' => '足高たかみ', 'kana' => 'アシダカタカミ', 'type' => '原作', ),array( 'name' => '唐辛子ひでゆ', 'kana' => 'トウガラシヒデユ', 'type' => '作画', ),array( 'name' => '椋本夏夜', 'kana' => 'クラモトカヤ', 'type' => 'キャラクター原案', ), ), ),
array('id' => 10079557,'opus' => array(array( 'name' => '足高たかみ', 'kana' => 'アシダカタカミ', 'type' => '原作', ),array( 'name' => '唐辛子ひでゆ', 'kana' => 'トウガラシヒデユ', 'type' => '作画', ),array( 'name' => '椋本夏夜', 'kana' => 'クラモトカヤ', 'type' => 'キャラクター原案', ), ), ),
array('id' => 10079558,'opus' => array(array( 'name' => '伏(龍)', 'kana' => 'フクリュウ', 'type' => '原作', ),array( 'name' => '小島紗', 'kana' => 'コジマサヤ', 'type' => '作画', ), ), ),
array('id' => 10079559,'opus' => array(array( 'name' => '小野中彰大', 'kana' => 'オノナカアキヒロ', 'type' => '著', ), ), ),
array('id' => 10079560,'opus' => array(array( 'name' => '斎創', 'kana' => 'サイソウ', 'type' => '著', ), ), ),
array('id' => 10079561,'opus' => array(array( 'name' => '夏未るゆ', 'kana' => 'ナツミルユ', 'type' => '著', ), ), ),
array('id' => 10079562,'opus' => array(array( 'name' => '冬野なべ', 'kana' => 'フユノナベ', 'type' => '作画', ),array( 'name' => 'カモメ山脈', 'kana' => 'カモメサンミャク', 'type' => '原作', ), ), ),
array('id' => 10079563,'opus' => array(array( 'name' => 'つたの葉', 'kana' => 'ツタノハ', 'type' => '作画', ),array( 'name' => 'Project シンフォギアⅩⅤ', 'kana' => 'プロジェクトシンフォギアエクシヴ', 'type' => '監', ), ), ),
array('id' => 10079564,'opus' => array(array( 'name' => 'もくふう', 'kana' => 'モクフウ', 'type' => '著', ), ), ),
array('id' => 10079565,'opus' => array(array( 'name' => 'のり伍郎', 'kana' => 'ノリゴロウ', 'type' => '著', ), ), ),
array('id' => 10079566,'opus' => array(array( 'name' => 'スケラッコ', 'kana' => 'スケラッコ', 'type' => '著', ), ), ),
array('id' => 10079567,'opus' => array(array( 'name' => '睦月', 'kana' => 'ムツキ', 'type' => '著', ), ), ),
array('id' => 10079568,'opus' => array(array( 'name' => 'シャチ', 'kana' => 'シャチ', 'type' => '原作', ),array( 'name' => '茶原', 'kana' => 'チャゲン', 'type' => '作画', ), ), ),
array('id' => 10079569,'opus' => array(array( 'name' => 'ダイヤモンド', 'kana' => 'ダイヤモンド', 'type' => '原作', ),array( 'name' => '剛田ナギ', 'kana' => 'ゴウダナギ', 'type' => '作画', ), ), ),
array('id' => 10079570,'opus' => array(array( 'name' => '氷堂リョージ', 'kana' => 'ヒドウリョージ', 'type' => '著', ), ), ),
array('id' => 10079571,'opus' => array(array( 'name' => 'ショウマケイト', 'kana' => 'ショウマケイト', 'type' => '著', ), ), ),
array('id' => 10079572,'opus' => array(array( 'name' => '朝野やぐら', 'kana' => 'アサノヤグラ', 'type' => '著', ), ), ),
array('id' => 10079573,'opus' => array(array( 'name' => '朝野やぐら', 'kana' => 'アサノヤグラ', 'type' => '著', ), ), ),
array('id' => 10079574,'opus' => array(array( 'name' => '天獅子悦也', 'kana' => 'アマジシエツヤ', 'type' => '著', ), ), ),
array('id' => 10079577,'opus' => array(array( 'name' => 'ナット・セガロフ', 'kana' => 'ナット セガロフ', 'type' => '著', ),array( 'name' => '富永晶子', 'kana' => 'トミナガ アキコ', 'type' => '訳', ), ), ),
array('id' => 10079578,'opus' => array(array( 'name' => 'にしかわたく', 'kana' => 'ニシカワ タク', 'type' => '著', ),array( 'name' => '高部正樹', 'kana' => 'タカベ マサキ', 'type' => '協力', ), ), ),
array('id' => 10079579,'opus' => array(array( 'name' => 'さくらはな。', 'kana' => 'サクラハナ', 'type' => '著', ),array( 'name' => '山口恵梨子', 'kana' => 'ヤマグチエリコ', 'type' => '協力', ), ), ),
array('id' => 10079580,'opus' => array(array( 'name' => 'ゆきたこーすけ', 'kana' => 'ユキタコースケ', 'type' => '著', ), ), ),
array('id' => 10079581,'opus' => array(array( 'name' => 'さいおなお', 'kana' => 'サイオ ナオ', 'type' => '著', ), ), ),
array('id' => 10079582,'opus' => array(array( 'name' => 'いおり', 'kana' => 'イオリ', 'type' => '著', ),array( 'name' => 'すずね凜', 'kana' => 'スズネ リン', 'type' => '原作', ), ), ),
array('id' => 10079583,'opus' => array(array( 'name' => 'いおり', 'kana' => 'イオリ', 'type' => '著', ),array( 'name' => 'すずね凜', 'kana' => 'スズネ リン', 'type' => '原作', ), ), ),
array('id' => 10079584,'opus' => array(array( 'name' => 'いおり', 'kana' => 'イオリ', 'type' => '著', ),array( 'name' => 'すずね凜', 'kana' => 'スズネ リン', 'type' => '原作', ), ), ),
array('id' => 10079585,'opus' => array(array( 'name' => '春野あめ', 'kana' => 'ハルノ アメ', 'type' => '著', ),array( 'name' => '中島美鈴', 'kana' => 'ナカシマ ミスズ', 'type' => '監', ), ), ),
array('id' => 10079586,'opus' => array(array( 'name' => '最上うみみ', 'kana' => 'サイジョウ ウミミ', 'type' => '著', ), ), ),
array('id' => 10079587,'opus' => array(array( 'name' => 'こいけまり', 'kana' => 'コイケマリ', 'type' => '著', ), ), ),
array('id' => 10079588,'opus' => array(array( 'name' => '鵠', 'kana' => 'クグイ', 'type' => '著', ),array( 'name' => 'あらと安里', 'kana' => 'アラトアサト', 'type' => '画', ), ), ),
array('id' => 10079589,'opus' => array(array( 'name' => '正木信太郎', 'kana' => 'マサキ シンタロウ', 'type' => '著', ), ), ),
array('id' => 10079590,'opus' => array(array( 'name' => 'ソフィ・ラポルト', 'kana' => 'ソフィ ラポルト', 'type' => '著', ),array( 'name' => '旦紀子', 'kana' => 'ダン ノリコ', 'type' => '訳', ), ), ),
array('id' => 10079591,'opus' => array(array( 'name' => 'ジュリア・クイン', 'kana' => 'ジュリア クイン', 'type' => '著', ),array( 'name' => 'スーザン・イーノック', 'kana' => 'スーザン イーノック', 'type' => '著', ),array( 'name' => 'カレン・ホーキンス', 'kana' => 'カレン ホーキンス', 'type' => '著', ),array( 'name' => 'ミア・ライアン', 'kana' => 'ミア ライアン', 'type' => '著', ), ), ),
array('id' => 10079592,'opus' => array(array( 'name' => 'ジェームズ・ロリンズ', 'kana' => 'ジェームズ ロリンズ', 'type' => '著', ),array( 'name' => '桑田 健', 'kana' => 'クワタ タケシ', 'type' => '訳', ), ), ),
array('id' => 10079593,'opus' => array(array( 'name' => 'ジェームズ・ロリンズ', 'kana' => 'ジェームズ ロリンズ', 'type' => '著', ),array( 'name' => '桑田 健', 'kana' => 'クワタ タケシ', 'type' => '訳', ), ), ),
array('id' => 10079594,'opus' => array(array( 'name' => '月夜野繭', 'kana' => 'ツキヨノ マユ', 'type' => '著', ),array( 'name' => '黒田うらら', 'kana' => 'クロダ ウララ', 'type' => '画', ), ), ),
array('id' => 10079595,'opus' => array(array( 'name' => 'イシクロ', 'kana' => 'イシクロ', 'type' => '著', ),array( 'name' => '三浦ひらく', 'kana' => 'ミウラ ヒラク', 'type' => '画', ), ), ),
array('id' => 10079596,'opus' => array(array( 'name' => '秀 香穂里', 'kana' => 'シュウ カオリ', 'type' => '著', ),array( 'name' => '奈良千春', 'kana' => 'ナラチハル', 'type' => '画', ), ), ),
array('id' => 10079597,'opus' => array(array( 'name' => 'いおかいつき', 'kana' => 'イオカイツキ', 'type' => '著', ),array( 'name' => '小路龍流', 'kana' => 'コウジ タツル', 'type' => '画', ), ), ),
array('id' => 10079598,'opus' => array(array( 'name' => '劇漫編集部', 'kana' => 'ゲキマンヘンシュウブ', 'type' => '編', ), ), ),
array('id' => 10079599,'opus' => array(array( 'name' => 'クレイン', 'kana' => 'クレイン', 'type' => '著', ),array( 'name' => 'ウエハラ蜂', 'kana' => 'ウエハラ ハチ', 'type' => '画', ), ), ),
array('id' => 10079600,'opus' => array(array( 'name' => 'あさぎ千夜春', 'kana' => 'アサギ チヨハル', 'type' => '著', ),array( 'name' => 'Cie', 'kana' => 'シエル', 'type' => '画', ), ), ),
array('id' => 10079601,'opus' => array(array( 'name' => '北山すずな', 'kana' => 'キタヤマ スズナ', 'type' => '著', ),array( 'name' => '旭炬', 'kana' => 'アサヒコ', 'type' => '画', ), ), ),
array('id' => 10079602,'opus' => array(array( 'name' => '熊野まゆ', 'kana' => 'クマノ マユ', 'type' => '著', ),array( 'name' => 'Fay', 'kana' => 'フェイ', 'type' => '画', ), ), ),
array('id' => 10079603,'opus' => array(array( 'name' => 'ささゆき細雪', 'kana' => 'ササユキ サユキ', 'type' => '著', ),array( 'name' => '千影透子', 'kana' => 'チカゲ トオコ', 'type' => '画', ), ), ),
array('id' => 10079604,'opus' => array(array( 'name' => '八神淳一', 'kana' => 'ヤガミ ジュンイチ', 'type' => '著', ), ), ),
array('id' => 10079605,'opus' => array(array( 'name' => '葉月奏太', 'kana' => 'ハヅキ ソウタ', 'type' => '著', ), ), ),
array('id' => 10079606,'opus' => array(array( 'name' => '橘真児', 'kana' => 'タチバナ シンジ', 'type' => '著', ), ), ),
array('id' => 10079607,'opus' => array(array( 'name' => '九坂久太郎', 'kana' => 'クサカ キュウタロウ', 'type' => '著', ), ), ),
array('id' => 10079608,'opus' => array(array( 'name' => '庵乃音人', 'kana' => 'アンノ', 'type' => '著', ), ), ),
array('id' => 10079609,'opus' => array(array( 'name' => '八神淳一', 'kana' => 'ヤガミ ジュンイチ', 'type' => '著', ), ), ),
array('id' => 10079610,'opus' => array(array( 'name' => '加藤一', 'kana' => 'カトウ ハジメ', 'type' => '編著', ),array( 'name' => '久田樹生', 'kana' => 'ヒサダ タツキ', 'type' => '著', ),array( 'name' => '渡部正和', 'kana' => 'ワタナベ マサカズ', 'type' => '著', ),array( 'name' => '深澤夜', 'kana' => 'フカサワ ヨル', 'type' => '著', ), ), ),
array('id' => 10079611,'opus' => array(array( 'name' => '神沼三平太', 'kana' => 'カミヌマ サンペイタ', 'type' => '著', ), ), ),
array('id' => 10079612,'opus' => array(array( 'name' => '影絵草子', 'kana' => 'カゲエ ゾウシ', 'type' => '著', ), ), ),
array('id' => 10079613,'opus' => array(array( 'name' => '鶴乃大助', 'kana' => 'ツルノ ダイスケ', 'type' => '著', ),array( 'name' => '卯ちり', 'kana' => 'ウチリ', 'type' => '著', ),array( 'name' => '戦狐', 'kana' => 'イクサギツネ', 'type' => '著', ), ), ),
array('id' => 10079614,'opus' => array(array( 'name' => '牛抱せん夏', 'kana' => 'ウシダキ センカ', 'type' => '著', ), ), ),
array('id' => 10079615,'opus' => array(array( 'name' => '宇津呂鹿太郎', 'kana' => 'ウツロ シカタロウ', 'type' => '著', ), ), ),
array('id' => 10079616,'opus' => array(array( 'name' => '籠三蔵', 'kana' => 'カゴ サンゾウ', 'type' => '著', ), ), ),
array('id' => 10079617,'opus' => array(array( 'name' => 'クダマツヒロシ', 'kana' => 'クダマツ ヒロシ', 'type' => '著', ), ), ),
array('id' => 10079618,'opus' => array(array( 'name' => '冨士玉目', 'kana' => 'フジ タマメ', 'type' => '著', ), ), ),
array('id' => 10079619,'opus' => array(array( 'name' => 'マキハラススム', 'kana' => 'マキハラススム', 'type' => '写真', ), ), ),
array('id' => 10079620,'opus' => array(array( 'name' => '田村浩章', 'kana' => 'タムラ ヒロアキ', 'type' => '写真', ), ), ),
array('id' => 10079621,'opus' => array(array( 'name' => '富田恭透', 'kana' => 'トミタ ヤスユキ', 'type' => '写真', ), ), ),
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
  // 本番用
  $dsn = 'pgsql:dbname=d3uldjpkj3ctch;host=ec2-52-204-191-143.compute-1.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'u79urs9of0un6s', 'p34d02ab02bf28b14e66b09bc464b4b3e75840bfa9418dba10202fbe1840f91ec');
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
      $name_search = tools::convertSearchText($v1['name']);
      $namekana_search = tools::convertSearchText($v1['name'] . $v1['kana']);

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

?>