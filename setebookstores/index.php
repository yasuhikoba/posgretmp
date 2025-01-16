<?php
require_once('../tools.php');

$datalist = array(
  10123376 => array(array( 'name' => 'Amazon Kindle', 'url' => 'https://www.amazon.co.jp/dp/B0DNS3JMQ7', 'public_status' => 1, ), array( 'name' => '楽天Kobo', 'url' => 'https://books.rakuten.co.jp/rk/7c1908746f593c808e1fd00ca628112b/?l-id=search-c-item-text-01', 'public_status' => 1, ), array( 'name' => 'honto 電子書籍ストア', 'url' => 'https://honto.jp/ebook/pd_33877961.html', 'public_status' => 1, ), array( 'name' => 'Maruzen eBook Library', 'url' => 'https://kw.maruzen.co.jp/ims/itemDetail.html?itmCd=1039707863', 'public_status' => 1, ), ),
  10123377 => array(array( 'name' => 'Amazon Kindle', 'url' => 'https://www.amazon.co.jp/dp/B0DNS1PGZ4', 'public_status' => 1, ), array( 'name' => '楽天Kobo', 'url' => 'https://books.rakuten.co.jp/rk/9887cd8c3d823741a93a6c9982e6c710/?l-id=search-c-item-text-01', 'public_status' => 1, ), array( 'name' => 'honto 電子書籍ストア', 'url' => 'https://honto.jp/ebook/pd_33877960.html', 'public_status' => 1, ), array( 'name' => 'Maruzen eBook Library', 'url' => 'https://kw.maruzen.co.jp/ims/itemDetail.html?itmCd=1039707862', 'public_status' => 1, ), ),
  10123380 => array(array( 'name' => 'Amazon Kindle', 'url' => 'https://www.amazon.co.jp/dp/B0DP46XJFH', 'public_status' => 1, ), array( 'name' => '楽天Kobo', 'url' => 'https://books.rakuten.co.jp/rk/a040d701c317301cb2d3ee394226fbe7/?l-id=search-c-item-text-01', 'public_status' => 1, ), array( 'name' => 'honto 電子書籍ストア', 'url' => 'https://honto.jp/ebook/pd_33884941.html', 'public_status' => 1, ), array( 'name' => 'Maruzen eBook Library', 'url' => 'https://kw.maruzen.co.jp/ims/itemDetail.html?itmCd=1039743486', 'public_status' => 1, ), ),
);

// ★★ 既存のurlを問答無用で上書きしてしまう。なにかしら対応が必要（上記の配列で添字urlがない場合は上書きしない等）

// ↑ bookID が キー。その中が書店の配列、それぞれname、url、public_status を指定
// 10094701 => array(
//   array(
//     "name" => "Amazon Kindle",
//     "url" => "http://www.amazon.co.jp/exec/obidos/ASIN/B07DNVP74X/sekaibunkacom-22",
//     "public_status" => 1,
//   ),
//   array(
//     "name" => "紀伊国屋書店Kinoppy",
//     "url" => "https://www.kinokuniya.co.jp/f/dsg-08-EK-0557701",
//     "public_status" => 1,
//   ),
// ),
//
// 下記で対応
// S:\マイドライブ\hondana\sekaibunka_世界文化社\SEKAIBUNKA_DEV-34 電子書籍商品のデータ一括更新

// アクセス
// http://localhost:8081/setebookstores/

// $publisher_id = 24;
// $publisher_id = 86; // 学陽書房 pro stg
// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1165; // 世界文化社 pro
// $publisher_id = 1177; // 世界文化社 stg
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

// 電子書籍書店データ取得
$ebookstores = array();
$sql = "select * from ebookstores;";
foreach ($db->query($sql) as $row) {
  $ebookstores[$row["name"]] = $row;
}

ob_start();

$roop = 0;
foreach ($datalist as $bookid => $v) {
  // 書誌の存在チェック
  $sql = "select id from books where id = '{$bookid}' and publisher_id = {$publisher_id};";
  $sth = $db->query($sql);
  $book = $sth->fetch(PDO::FETCH_ASSOC);
  if(empty($book)) {
    // 書誌データがない場合は スキップ
    echo "!! not book data id {$bookid}<br>";
    continue;
  }

  // 電子書籍書店のループ
  foreach ($v as $k2 => $v2) {
    // 電子書籍書店名は「 紀伊國屋書店 Kinoppy」にスペースが入っているので、trimしない
    // $v2["name"] = trim($v2["name"]);
    $v2["url"] = trim($v2["url"]);
    if(!array_key_exists($v2["name"],$ebookstores)) {
      // 存在しない書店が設定されている
      echo "!! not book data id {$bookid} not shop {$v2["name"]}<br>";
      continue;
    }
    // レコード存在チェック
    $sql = "select * from book_ebookstores where book_id = {$bookid} and ebookstore_id = {$ebookstores[$v2["name"]]["id"]};";
    $sth = $db->query($sql);
    $book_ebookstores = $sth->fetch(PDO::FETCH_ASSOC);
    if(empty($book_ebookstores)) {
      // レコード追加
      $sql = "insert into book_ebookstores (book_id,ebookstore_id,url,public_status,created_at,updated_at) values ({$bookid},{$ebookstores[$v2["name"]]["id"]},'{$v2["url"]}',{$v2["public_status"]},now(),now());";
      if($db->exec($sql) !== false) {
        echo "success insert id {$bookid} > {$v2["name"]}<br>";
      } else {
        echo "!! add book_ebookstores error id {$bookid} > {$v2["name"]}<br>";
      }
    } else {
      // レコード更新
      $sql = "update book_ebookstores set url = '{$v2["url"]}',public_status = {$v2["public_status"]},updated_at = now() where id = {$book_ebookstores["id"]};";
      if($db->exec($sql) !== false) {
        echo "success update id {$bookid} > {$v2["name"]}<br>";
      } else {
        echo "!! update book_ebookstores error id {$bookid} > {$v2["name"]}<br>";
      }
    }

  }


  $roop++;
  echo $roop . " / " . $datacount . " bookid:" . $bookid . "<br>";
  flush();
  ob_flush();
}
flush();
ob_flush();

ob_end_flush();

echo "end!!";
exit();
