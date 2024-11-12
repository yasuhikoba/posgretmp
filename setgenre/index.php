<?php
require_once('../tools.php');

$datalist = array(
  10093810 => '映像 > EVO',
  10093811 => '映像 > EVO',
  10093812 => '映像 > EVO',
);

// ！！！！！！！！！！！！！！
// ！！！実行後は bookCountの再計算処理を実行する！！！
// ！！！！！！！！！！！！！！
//
// ジャンル名に ' が入っている場合は考慮できていない(setformatは考慮している)
// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1276; // 丸善出版 stg
// $publisher_id = 1165; // 世界文化社 pro
$publisher_id = 1276; // 丸善出版 stg

/**
* 環境
*/
// $env = 'pro';
$env = 'stg';
// $env = 'docker';

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));

$datacount = count($datalist);

ob_start();

$i = 0;
$roop = 0;
foreach ($datalist as $k => $v) {
  // 書誌の存在チェック
  $sql = "select id from books where id = '{$k}' and publisher_id = {$publisher_id};";
  $sth = $db->query($sql);
  $book = $sth->fetch(PDO::FETCH_ASSOC);
  if(empty($book)) {
    // 書誌データがない場合は スキップ
    echo "not book data id {$k}<br>";
    flush();
    ob_flush();
    continue;
  }

  // ジャンル分割
  $genrelist = explode('|',$v);
  foreach ($genrelist as $gk => $gv) {
    $gv = trim($gv);
    // 階層構造 分割
    $gt = explode('>',$gv);
    $depth = count($gt);
    if($depth > 3) {
      // 4階層目以降が設定されているため エラー
      echo "depth error book id {$k}<br>";
      flush();
      ob_flush();
      break;
    }
    $pg = null;
    foreach ($gt as $gtk => $gtv) {
      $gtv = trim($gtv);
      if($gtk == 0) {
        // 1階層 登録確認
        $sql = "select * from genres where publisher_id = {$publisher_id} and name = '{$gtv}';";
      } else {
        // 2階層目以降 登録確認
        $sql = "select * from genres where publisher_id = {$publisher_id} and name = '{$gtv}' and lft > {$pg['lft']} and rgt < {$pg['rgt']};";
      }
      $sth = $db->query($sql);
      $g = $sth->fetch(PDO::FETCH_ASSOC);
      if(empty($g)) {
        // ジャンルの登録が必要
        if($gtk == 0) {
          // 1階層 登録

          // 最大のrgt値取得
          $sql2 = "select max(rgt) from genres where publisher_id = {$publisher_id}";
          $sth = $db->query($sql2);
          $r = $sth->fetch(PDO::FETCH_ASSOC);
          $maxlft = 0;
          if ( !empty($r) && !empty($r['max'])) {
            $maxlft = $r['max'];
          }
          $name_search = tools::convertSearchText($gtv);
          $isql = "insert into genres (name,publisher_id,lft,rgt,depth,created_at,updated_at,name_search) values ('{$gtv}',{$publisher_id}," . ($maxlft + 1) . "," . ($maxlft + 2) . ",{$gtk},now(),now(),'{$name_search}');";
        } else {
          // 2階層目以降 登録

          // 既存のジャンルのlftとrgtを調整して
          // 追加するスペースを用意する
          $isql = "update genres set lft = lft+2 where publisher_id = {$publisher_id} and lft >= {$pg['rgt']};";
          if($db->exec($isql) === false) {
            echo "lft change error book id {$k}<br>";
            flush();
            ob_flush();
            break 2;
          }
          $isql = "update genres set rgt = rgt+2 where publisher_id = {$publisher_id} and rgt >= {$pg['rgt']};";
          if($db->exec($isql) === false) {
            echo "rgt change error book id {$k}<br>";
            flush();
            ob_flush();
            break 2;
          }

          $name_search = tools::convertSearchText($gtv);
          $isql = "insert into genres (name,publisher_id,parent_id,lft,rgt,depth,created_at,updated_at,name_search) values ('{$gtv}',{$publisher_id},{$pg['id']},{$pg['rgt']}," . ($pg['rgt'] + 1) . ",{$gtk},now(),now(),'{$name_search}');";
        }
        if($db->exec($isql) === false) {
          echo "not insert genre skip book id {$k}<br>";
          flush();
          ob_flush();
          break 2;
        }
        // 再取得
        if($gtk != 0) {
          // lft,rgt値が変わっているため、親から再取得
          $sql2 = "select * from genres where publisher_id = {$publisher_id} and id = '{$pg['id']}';";
          $sth = $db->query($sql2);
          $pg = $sth->fetch(PDO::FETCH_ASSOC);
          if(empty($pg)) {
            echo "not get parent genre skip book id {$k}<br>";
            flush();
            ob_flush();
            break 2;
          }
          $sql = "select * from genres where publisher_id = {$publisher_id} and name = '{$gtv}' and lft > {$pg['lft']} and rgt < {$pg['rgt']};";
        }
        $sth = $db->query($sql);
        $g = $sth->fetch(PDO::FETCH_ASSOC);
        if(empty($g)) {
          echo "not get insert genre skip book id {$k}<br>";
          flush();
          ob_flush();
          break 2;
        }
      }
      // 親ジャンルとして退避
      $pg = $g;
      if(($gtk + 1) == count($gt)) {
        // 中間テーブルへ レコード追加

        // 既に レコードがないかチェックする
        $sql = "select * from book_genres where book_id = {$book['id']} and genre_id = {$g['id']}";
        $sth = $db->query($sql);
        $bg = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($bg)) {
          // 既にレコードがある場合は スキップ
          echo "book_genre exists id {$k}<br>";
          flush();
          ob_flush();
          continue;
        }

        $isql = "insert into book_genres (book_id,genre_id,created_at,updated_at) values ({$book['id']},{$g['id']},now(),now());";
        if($db->exec($isql) === false) {
          echo "not set book_genre skip book id {$k}<br>";
          flush();
          ob_flush();
          break 2;
        }
      }
    }
  }

  $i++;
  $roop++;
  // if($i > 20) {
    // 20回まわったら ページ出力
    echo $roop . " / " . $datacount . " id:" . $k . "<br>";
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
