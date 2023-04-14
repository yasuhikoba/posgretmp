<?php

ob_start();

$publisher_id = 1003;
$publisher_key = 'sunmark'; // ファイル名で使用
$debug = true;

if($debug) {
  // STG用
  $dsn = 'pgsql:dbname=d32hupuj29g33c;host=ec2-44-206-11-200.compute-1.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'rszgmnfrbqlgot', '237cbd5e1db3db80228bbf1483cd208c850e4d22bfd12c85b7e317b1cc569700');
  $publisher_key .= '-stg';
  $publisher_id = 1006;
} else {
  // 本番用
  $dsn = 'pgsql:dbname=d3uldjpkj3ctch;host=ec2-34-233-148-141.compute-1.amazonaws.com;port=5432';
  $db = new PDO($dsn, 'u43nqlr506q4qg', 'pd20127aa81443c772b163cc2eb6c9960b8735bb9a29528e868c86af98c8ed8ed');
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
  "ShopifyProductID",
  "YONDEMILLContentID",
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
  b.id,
  replace(b.shopify_product_id,'gid://shopify/Product/','') as shopify_product_id,
  replace(replace(b.yondemill_book_sales_url,'https://www.yondemill.jp/contents/',''),'?view=1','') as yondemill_book_sales_url

  from books as b

  where b.publisher_id = {$publisher_id}

  limit {$limit} offset {$offset}
  ;";

  // bookのループ（1行）
  $sth = $db->query($sql);
  while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    // デフォルトのタイムゾーンを UTCへ
    date_default_timezone_set('UTC');

    foreach ($row as $k => $v) {
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
