<?php
require_once('../tools.php');

// アクセスURL
// http://localhost/img_download/

$imghost = '';
$adminhost = '';
$uploadhost = 'https://test.hondana.jp/';

/**
* 出版社ID
*/
// $publisher_id = 1084; // 白夜書房 本番
$publisher_id = 1027; // 白夜書房 STG

/**
* 環境
*/
// $env = 'pro';
$env = 'stg';
// $env = 'docker';

if($env == 'pro') {
  // 本番用
  $imghost = 'https://hondana-image.s3.amazonaws.com/book/';
  $adminhost = 'https://admin.hondana.jp/publisher_console/';
} elseif($env == 'stg') {
  // STG用
  $imghost = 'https://hondana-cms-image.s3.amazonaws.com/book/';
  $adminhost = 'https://hondana-t-cms.herokuapp.com/publisher_console/';
} else {
  echo "end!!";
  exit();
}
$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));


$sql = "select count(*) as cnt
  from books as b
  where b.publisher_id = {$publisher_id} and (image is not null or sub_images is not null);";

$sth = $db->query($sql);
$row = $sth->fetch(PDO::FETCH_ASSOC);
$count = $row['cnt'];

$limit = 20;
$page = ceil($count / $limit);

ob_start();

// ヘッダー出力
$header = array(
  "BookID",
  "書影1（メイン）URL",
  "書影2（サブ）URL",
  "書影3（サブ）URL",
  "書影4（サブ）URL",
  "書影5（サブ）URL",
  "書影6（サブ）URL",
  "備考",
);
echo implode($header,'||');
echo "<br>";

// 一定数ごとにループ
// 途中で処理が止まってしまった場合は 下記の $i の初期値を変更して再実行させる
// 3000件目からスタートさせる場合 3000 / 20 → 150を設定する
for ($i=0; $i < $page; $i++) {
  $offset = $limit * $i;
  $sql = "select DISTINCT
  b.id,b.image,b.sub_images

  from books as b

  where b.publisher_id = {$publisher_id} and (image is not null or sub_images is not null)

  order by b.id

  limit {$limit} offset {$offset}
  ;";

  // bookのループ（1行）
  $sth = $db->query($sql);
  while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $message = '';

    // IDを画面出力
    echo $row['id'];
    echo "||"; // 後で置換用の区切り文字

    // メイン画像の存在チェック
    if(!empty($row['image'])) {
      $imgurl = $imghost . 'image/' . $row['id'] . '/' . $row['image'];
      $data = @file_get_contents($imgurl);
      if(!empty($data)) {
        // ミドルの書影がないことを確認
        $imgMurl = $imghost . 'image/' . $row['id'] . '/middle_' . $row['image'];
        $dataM = @file_get_contents($imgMurl);
        if(empty($dataM)) {
          // ファイルダウンロードしてローカルに保存
          $dir = "upload/hdnp/{$publisher_id}/{$row['id']}/main/";
          if (!file_exists($dir)) {
            // ディレクトリの存在を確認
            mkdir( $dir, 0777, true );
          }
          if(@file_put_contents($dir . $row['image'],$data) !== false) {
            echo $uploadhost . $dir . $row['image'];
          } else {
            $message .= 'メイン失敗 ';
          }
        } else {
            $message .= 'メインミドルあり ';
        }
      }
    }

    echo "||"; // 後で置換用の区切り文字

    // サブ画像の存在チェック
    if(!empty($row['sub_images'])) {
      $sub = trim($row['sub_images'],"[]");
      $subs = explode(",", $sub);
      $m = 0;
      foreach ($subs as $k => $v) {
        $m++;
        $v = trim($v, '" ');
        $imgurl = $imghost . 'sub_images/' . $row['id'] . '/' . $v;
        $data = @file_get_contents($imgurl);
        if(!empty($data)) {
          // ミドルの書影がないことを確認
          $imgMurl = $imghost . 'sub_images/' . $row['id'] . '/middle_' . $v;
          $dataM = @file_get_contents($imgMurl);
          if(empty($dataM)) {
            // ファイルダウンロードしてローカルに保存
            $dir = "upload/hdnp/{$publisher_id}/{$row['id']}/sub/";
            if (!file_exists($dir)) {
              // ディレクトリの存在を確認
              mkdir( $dir, 0777, true );
            }
            if(@file_put_contents($dir . $v,$data) !== false) {
              echo $uploadhost . $dir . $v;
            } else {
              $message .= "サブ{$m}失敗 ";
            }
          } else {
            $message .= "サブ{$m}ミドルあり ";
          }
        }
        echo "||"; // 後で置換用の区切り文字
      }
      // 残りの区切り文字だけ挿入
      for ($j=$m; $j <= 5; $j++) {
        echo "||"; // 後で置換用の区切り文字
      }
    } else {
      // 区切り文字だけ挿入
      for ($j=1; $j <= 5; $j++) {
        echo "||"; // 後で置換用の区切り文字
      }
    }
    echo $message;
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
