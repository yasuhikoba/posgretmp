<?php
require_once('../tools.php');

$datalist = array(
  10123776 => '終わりのない生命の物語 ～7つのケースで考える生命倫理～',
  10123777 => '終わりのない生命の物語 ～7つのケースで考える生命倫理～',
  10123778 => '終わりのない生命の物語 ～7つのケースで考える生命倫理～',


);

// ！！！！！！！！！！！！！！
// ！！！実行後は bookCountの再計算処理を実行する！！！
// ！！！！！！！！！！！！！！

// シリーズ名に ' が入っている場合は考慮できていない(setformatは考慮している)
// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1276; // 丸善出版 stg
$publisher_id = 1203; // 丸善出版 pro
// $publisher_id = 1165; // 世界文化社 pro

/**
* 環境
*/
// $env = 'pro';
// $env = 'stg';
$env = 'docker';

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

  // シリーズ分割
  $serieslist = explode('|',$v);
  foreach ($serieslist as $gk => $gv) {
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
        $sql = "select * from series where publisher_id = {$publisher_id} and name = '{$gtv}' and depth = {$gtk};";
      } else {
        // 2階層目以降 登録確認
        $sql = "select * from series where publisher_id = {$publisher_id} and name = '{$gtv}' and depth = {$gtk} and lft > {$pg['lft']} and rgt < {$pg['rgt']};";
      }
      $sth = $db->query($sql);
      $g = $sth->fetch(PDO::FETCH_ASSOC);
      if(empty($g)) {
        // シリーズの登録が必要
        if($gtk == 0) {
          // 1階層 登録

          // 最大のrgt値取得
          $sql2 = "select max(rgt) from series where publisher_id = {$publisher_id}";
          $sth = $db->query($sql2);
          $r = $sth->fetch(PDO::FETCH_ASSOC);
          $maxlft = 0;
          if ( !empty($r) && !empty($r['max'])) {
            $maxlft = $r['max'];
          }
          $name_search = tools::convertSearchText($gtv);
          $isql = "insert into series (name,publisher_id,lft,rgt,depth,created_at,updated_at,name_search) values ('{$gtv}',{$publisher_id}," . ($maxlft + 1) . "," . ($maxlft + 2) . ",{$gtk},now(),now(),'{$name_search}');";
        } else {
          // 2階層目以降 登録

          // 既存のシリーズのlftとrgtを調整して
          // 追加するスペースを用意する
          $isql = "update series set lft = lft+2 where publisher_id = {$publisher_id} and lft >= {$pg['rgt']};";
          if($db->exec($isql) === false) {
            echo "lft change error book id {$k}<br>";
            flush();
            ob_flush();
            break 2;
          }
          $isql = "update series set rgt = rgt+2 where publisher_id = {$publisher_id} and rgt >= {$pg['rgt']};";
          if($db->exec($isql) === false) {
            echo "rgt change error book id {$k}<br>";
            flush();
            ob_flush();
            break 2;
          }
          $name_search = tools::convertSearchText($gtv);
          $isql = "insert into series (name,publisher_id,parent_id,lft,rgt,depth,created_at,updated_at,name_search) values ('{$gtv}',{$publisher_id},{$pg['id']},{$pg['rgt']}," . ($pg['rgt'] + 1) . ",{$gtk},now(),now(),'{$name_search}');";
        }
        if($db->exec($isql) === false) {
          echo "not insert series skip book id {$k}<br>";
          flush();
          ob_flush();
          break 2;
        }
        // 再取得
        if($gtk != 0) {
          // lft,rgt値が変わっているため、親から再取得
          $sql2 = "select * from series where publisher_id = {$publisher_id} and id = '{$pg['id']}';";
          $sth = $db->query($sql2);
          $pg = $sth->fetch(PDO::FETCH_ASSOC);
          if(empty($pg)) {
            echo "not get parent series skip book id {$k}<br>";
            flush();
            ob_flush();
            break 2;
          }
          $sql = "select * from series where publisher_id = {$publisher_id} and name = '{$gtv}' and lft > {$pg['lft']} and rgt < {$pg['rgt']};";
        }
        $sth = $db->query($sql);
        $g = $sth->fetch(PDO::FETCH_ASSOC);
        if(empty($g)) {
          echo "not get insert series skip book id {$k}<br>";
          flush();
          ob_flush();
          break 2;
        }
      }
      // 親シリーズとして退避
      $pg = $g;
      if(($gtk + 1) == count($gt)) {
        // 中間テーブルへ レコード追加

        // 既に レコードがないかチェックする
        $sql = "select * from book_series where book_id = {$book['id']} and series_id = {$g['id']}";
        $sth = $db->query($sql);
        $bg = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($bg)) {
          // 既にレコードがある場合は スキップ
          echo "book_series exists id {$k}<br>";
          flush();
          ob_flush();
          continue;
        }

        $isql = "insert into book_series (book_id,series_id,created_at,updated_at) values ({$book['id']},{$g['id']},now(),now());";
        if($db->exec($isql) === false) {
          echo "not set book_series skip book id {$k}<br>";
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
