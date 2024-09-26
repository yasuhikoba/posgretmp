<?php

ob_start();

$publisher_id = 20;
$publisher_key = 'tkd-pbl'; // ファイル名で使用
$debug = false;

if($debug) {
  // STG用
  $dsn = 'pgsql:dbname=d23slp29mn3732;host=c5lpcjces8gqje.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'u2k8p4293tq6sk', 'p53c1137fc137540a98827d8bdb43b4ba05e11fba3eb8bf526398ef0ab14dbdf2');
  $publisher_key .= '-stg';
} else {
  // 本番用
  $dsn = 'pgsql:dbname=d3uldjpkj3ctch;host=ec2-52-204-191-143.compute-1.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'u79urs9of0un6s', 'p34d02ab02bf28b14e66b09bc464b4b3e75840bfa9418dba10202fbe1840f91ec');
  $publisher_key .= '-pro';
}

$sql = "select count(*) as cnt
  from books as b
  where b.publisher_id = {$publisher_id};";

$sth = $db->query($sql);
$row = $sth->fetch(PDO::FETCH_ASSOC);
$count = $row['cnt'];
$limit = 20;
$page = ceil($count / $limit);

// ヘッダー出力
$itemlist = array(
  "bookID",
  "書名",
  "書名カナ",
  "巻次",
  "サブタイトル",
  "サブタイトルカナ",
  "ISBN",
  "雑誌コード",
  "Cコード",
  "出版年月日",
  "書店発売日",
  "版",
  "版型",
  "ページ数",
  "本体価格",
  "概要長文",
  "概要短文",
  "目次",
  "内容説明",
  "公開日",
  "公開の状態",
  "新刊設定",
  "キーワード",
  "これから出る本設定",
  "おすすめ設定",
  "おすすめ紹介文",
  "おすすめ表示順",
  "在庫設定",
  "カート設定",
  "ジャンル",
  "シリーズ",
  "著者名1",
  "著者カナ1",
  "著者タイプ1",
  "著者名2",
  "著者カナ2",
  "著者タイプ2",
  "著者名3",
  "著者カナ3",
  "著者タイプ3",
  "著者名4",
  "著者カナ4",
  "著者タイプ4",
  "著者名5",
  "著者カナ5",
  "著者タイプ5",
  "著者名6",
  "著者カナ6",
  "著者タイプ6",
  "著者名7",
  "著者カナ7",
  "著者タイプ7",
  "著者名8",
  "著者カナ8",
  "著者タイプ8",
  "著者名9",
  "著者カナ9",
  "著者タイプ9",
  "著者名10",
  "著者カナ10",
  "著者タイプ10"
);

// UTF-8 BOM付き処理＋ヘッダー(Excelで開ける用の処理)
$header = pack('C*',0xEF,0xBB,0xBF) . implode(",",$itemlist);

header("Content-Type: application/octet-stream");
header("Content-disposition: attachment; filename=".$publisher_key . "-" . date('Ymd') . ".csv");
echo $header;

// 一定数ごとにループ
for ($i=0; $i < $page; $i++) {
  $offset = $limit * $i;
  $sql = "select DISTINCT
  b.id,b.name,b.kana,b.volume,b.sub_name,b.sub_kana
  ,b.isbn,b.magazine_code,b.c_code,b.book_date,b.release_date,
  b.version,b.book_size,b.page,b.price,b.outline,
  b.outline_abr,b.explain,b.content,b.public_date,
  b.public_status,new_status,b.keyword,b.next_book,
  b.recommend_status,b.recommend_sentence,
  b.recommend_order,b.stock_status,b.cart_status

  from books as b

  where b.publisher_id = {$publisher_id}

  limit {$limit} offset {$offset}
  ;";

  // bookのループ（1行）
  $sth = $db->query($sql);
  while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    // ジャンル取得
    $sql2 = "select
    concat(case when g3.name is not null then g3.name || '>' end ,case when g2.name is not null then g2.name || '>' end , g1.name) as text

    from genres as g1
    left join genres as g2 on g1.lft > g2.lft and g1.rgt < g2.rgt and g2.depth = 1 and g2.publisher_id = '{$publisher_id}'
    left join genres as g3 on g1.lft > g3.lft and g1.rgt < g3.rgt and g3.depth = 0 and g3.publisher_id = '{$publisher_id}'

    where g1.publisher_id = '{$publisher_id}'
    and exists (
      select 1
      from book_genres as bg
      where bg.book_id = '{$row['id']}'
      and bg.genre_id = g1.id
    );";

    $text = array();
    $sth2 = $db->query($sql2);
    while($row2 = $sth2->fetch(PDO::FETCH_ASSOC)){
      $text[] = $row2['text'];
    }
    $row['genre'] = implode("|",$text);

    // シリーズ取得
    $sql2 = "select
    concat(case when g3.name is not null then g3.name || '>' end ,case when g2.name is not null then g2.name || '>' end , g1.name) as text

    from series as g1
    left join series as g2 on g1.lft > g2.lft and g1.rgt < g2.rgt and g2.depth = 1 and g2.publisher_id = '{$publisher_id}'
    left join series as g3 on g1.lft > g3.lft and g1.rgt < g3.rgt and g3.depth = 0 and g3.publisher_id = '{$publisher_id}'

    where g1.publisher_id = '{$publisher_id}'
    and exists (
      select 1
      from book_series as bg
      where bg.book_id = '{$row['id']}'
      and bg.series_id = g1.id
    );";

    $text = array();
    $sth2 = $db->query($sql2);
    while($row2 = $sth2->fetch(PDO::FETCH_ASSOC)){
      $text[] = $row2['text'];
    }
    $row['series'] = implode("|",$text);

    // 著者データ取得
    $sql2 = "SELECT
      a.name,
      a.kana,
      case when o.author_type=16 and o.author_type_other is not null then o.author_type_other else cast(o.author_type as text) end as type

    from opuses as o
      left join authors as a
        on o.author_id = a.id

    where
      o.book_id = {$row['id']} and
      a.publisher_id = {$publisher_id}
    ;";

    $j = 0;
    $sth2 = $db->query($sql2);
    while($row2 = $sth2->fetch(PDO::FETCH_ASSOC)){
      $row["an".$j] = $row2['name'];
      $row["ak".$j] = $row2['kana'];
      switch ($row2['type']) {
        case '1':
          $row["at".$j] = '著';
          break;
        case '2':
          $row["at".$j] = '訳';
          break;
        case '3':
          $row["at".$j] = '作';
          break;
        case '4':
          $row["at".$j] = '原作';
          break;
        case '5':
          $row["at".$j] = '原案';
          break;
        case '6':
          $row["at".$j] = '編';
          break;
        case '7':
          $row["at".$j] = '編著';
          break;
        case '8':
          $row["at".$j] = '編訳';
          break;
        case '9':
          $row["at".$j] = '編注';
          break;
        case '10':
          $row["at".$j] = '監';
          break;
        case '11':
          $row["at".$j] = '監訳';
          break;
        case '12':
          $row["at".$j] = '文';
          break;
        case '13':
          $row["at".$j] = '絵';
          break;
        case '14':
          $row["at".$j] = '画';
          break;
        case '15':
          $row["at".$j] = '写真';
          break;
        case '17':
          $row["at".$j] = '脚本';
          break;
        case '18':
          $row["at".$j] = '作曲';
          break;
        case '19':
          $row["at".$j] = 'イラスト';
          break;
        case '20':
          $row["at".$j] = '解説';
          break;
        case '21':
          $row["at".$j] = '朗読';
          break;
        default:
          $row["at".$j] = $row2['type'];
      }
      $j++;
      if($j >= 10) {
        break;
      }
    }

    if($j < 10) {
      // 空の要素を追加
      while ($j >= 10) {
        $row["an".$j] = '';
        $row["ak".$j] = '';
        $row["at".$j] = '';
        $j++;
      }
    }

    // デフォルトのタイムゾーンを UTCへ
    date_default_timezone_set('UTC');

    foreach ($row as $k => $v) {
      if($k == 'public_status') {
        if($v == '1') {
          $v = '公開';
        } elseif($v == '2'){
          $v = '予約公開';
        } else {
          $v = '非公開';
        }
      } elseif($k == 'new_status') {
        if($v) {
          $v = '新刊';
        } else {
          $v = '新刊ではない';
        }
      } elseif($k == 'next_book') {
        if($v) {
          $v = 'これから出る本';
        } else {
          $v = 'これから出る本ではない';
        }
      } elseif($k == 'recommend_status') {
        if($v) {
          $v = 'おすすめ';
        } else {
          $v = '非おすすめ';
        }
      } elseif($k == 'book_size') {
        switch ($v) {
          case '1':
            $v = '4-6';
            break;
          case '2':
            $v = '4-6変';
            break;
          case '3':
            $v = 'B6';
            break;
          case '4':
            $v = 'B6変';
            break;
          case '5':
            $v = 'A5';
            break;
          case '6':
            $v = 'A5変';
            break;
          case '7':
            $v = '文庫';
            break;
          case '8':
            $v = '新書';
            break;
          case '9':
            $v = 'B5';
            break;
          case '10':
            $v = 'B5変';
            break;
          case '11':
            $v = 'A4';
            break;
          case '12':
            $v = 'A4変';
            break;
          case '13':
            $v = 'A6';
            break;
          case '14':
            $v = 'A6変';
            break;
          case '15':
            $v = 'AB';
            break;
          case '16':
            $v = 'B4';
            break;
          case '17':
            $v = '菊判';
            break;
          case '18':
            $v = '菊倍判';
            break;
          case '19':
            $v = '菊判変';
            break;
          case '20':
            $v = 'その他・規格外';
            break;
          case '21':
            $v = 'B7';
            break;
          default:
            $v = '';
        }
      } elseif($k == 'stock_status') {
        switch ($v) {
          case '1':
            $v = '在庫あり';
            break;
          case '2':
            $v = '在庫僅少';
            break;
          case '3':
            $v = '重版中';
            break;
          case '4':
            $v = '未刊・予約受付中';
            break;
          case '5':
            $v = '品切れ・重版未定';
            break;
          case '6':
            $v = '絶版';
            break;
          case '7':
            $v = 'オンデマンド制作';
            break;
          default:
            $v = '';
        }
      }elseif($k == 'cart_status') {
        if($v) {
          $v = 'カート無効';
        } else {
          $v = 'カート無効';
        }
      }elseif(
        $k == 'book_date' ||
        $k == 'release_date'
      ) {
        // 日付の変換処理
        if(!empty($v)) {
          $dt = new DateTime($v);
          $dt->setTimeZone(new DateTimeZone('Asia/Tokyo'));
          $v = $dt->format('Y/n/j');
        }
      }elseif($k == 'public_date') {
        // 日付の変換処理
        if(!empty($v)) {
          $dt = new DateTime($v);
          $dt->setTimeZone(new DateTimeZone('Asia/Tokyo'));
          $v = $dt->format('Y/n/j H:i:s');
        }
      }

      // 「"」をエスケープして追加
      if(preg_match('/"/',$v)) {
        $v = str_replace('"','""',$v);
      }
      if(preg_match('/[",\n]/',$v)) {
        // 「"」で囲むパターン
        $v = '"' . $v . '"';
      }
      $row[$k] = $v;
    }
    // 出力
    echo "\n" . implode(",",$row);

    flush();
    ob_flush();
  }
}

flush();
ob_flush();

ob_end_flush();

exit();
