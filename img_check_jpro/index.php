<?php
require_once('../tools.php');
tools::loadEnv();

// 指定日付より後にJPRO連携された書影を確認する

ob_start();

/**
 * 環境
 */
$env = 'pro';
// $env = 'stg';

$imghost = 'https://hondana-image.s3.amazonaws.com/book/image/';
$subimghost = 'https://hondana-image.s3.amazonaws.com/book/sub_images/';

if ($env == 'stg') {
  $imghost = 'https://hondana-cms-image.s3.amazonaws.com/book/image/';
  $subimghost = 'https://hondana-cms-image.s3.amazonaws.com/book/sub_images/';
}

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

$date = '2022-05-29';
$sql = "select count(b.*) as cnt from
books as b
left join book_jpros as bj on b.id = bj.id

where bj.id is not null and b.image is not null and bj.image_sent_at > '{$date}' and b.isbn != '' and b.jpro = true;";

$sth = $db->query($sql);
$row = $sth->fetch(PDO::FETCH_ASSOC);
$count = $row['cnt'];

$limit = 20;
$page = ceil($count / $limit);

// 一定数ごとにループ
// 途中で処理が止まってしまった場合は 下記の $i の初期値を変更して再実行させる
// 3000件目からスタートさせる場合 3000 / 20 → 150を設定する
for ($i = 0; $i < $page; $i++) {
  $offset = $limit * $i;
  $sql = "select b.id,b.name,b.publisher_id,b.image,b.sub_images,isbn,bj.image_sent_at from
  books as b
  left join book_jpros as bj on b.id = bj.id

  where bj.id is not null and b.image is not null and bj.image_sent_at > '{$date}' and b.isbn != '' and b.jpro = true

  order by b.id

  limit {$limit} offset {$offset}
  ;";

  // bookのループ（1行）
  $sth = $db->query($sql);
  while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    // 画像の存在チェック
    $imgurl = $imghost . $row['id'] . '/large_' . $row['image'];
    if (@file_get_contents($imgurl, false, null, 0, 100)) {
      echo $row['id'] . " ok";
      // echo $row['id'] . " ok " . $imgurl . "<br>";
    } else {
      // echo $row['id'] . " ng " . $imgurl . "<br>";
      echo $row['id'] . " ng https://admin.hondana.jp/publisher_console/{$row['publisher_id']}/books/{$row['id']}/edit {$imgurl}";
    }
    if (!empty($row['sub_images'])) {
      $sub = ltrim($row['sub_images'], '["');
      $sub = rtrim($sub, '"]');
      $sub = explode('", "', $sub);
      foreach ($sub as $k => $v) {
        $suburl = $subimghost . $row['id'] . '/large_' . $v;
        if (@file_get_contents($suburl, false, null, 0, 100)) {
          echo " sub ok";
        } else {
          echo " ng sub https://admin.hondana.jp/publisher_console/{$row['publisher_id']}/books/{$row['id']}/edit {$suburl}";
        }
      }
    }
    echo "<br>";

    flush();
    ob_flush();
  }
}

flush();
ob_flush();

ob_end_flush();

echo "end!!";

exit();
