<?php
require_once('../tools.php');

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
  array('id' => 10105070,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105071,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105072,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105073,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105074,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105075,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105076,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105077,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105078,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105079,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105080,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105081,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105082,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105083,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105084,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105085,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105086,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105087,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105088,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105089,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105090,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105091,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105092,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105093,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105094,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105095,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105096,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105097,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105098,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105099,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105100,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105101,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105102,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105103,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105104,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105105,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105106,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105107,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105108,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105109,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105110,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105111,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105112,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105113,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105114,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105115,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105116,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105117,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105118,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105119,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105120,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105121,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105122,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105123,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105124,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105125,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105126,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105127,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105128,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105129,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105130,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105131,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105132,'opus' => array(array( 'name' => '時計Begin編集部', 'kana' => 'トケイビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105133,'opus' => array(array( 'name' => '時計Begin編集部', 'kana' => 'トケイビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105134,'opus' => array(array( 'name' => '時計Begin編集部', 'kana' => 'トケイビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105135,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105136,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105137,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105138,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105139,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105140,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105141,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105142,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105143,'opus' => array(array( 'name' => 'Begin編集部', 'kana' => 'ビギンヘンシュウブ', 'type' => '編集', ) ), ),

array('id' => 10105145,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105146,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105147,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105148,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105149,'opus' => array(array( 'name' => 'LaLa Begin編集部', 'kana' => 'ララビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105150,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105151,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105152,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105153,'opus' => array(array( 'name' => "MEN''S EX編集部", 'kana' => 'メンズ ･エグゼクティブヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105154,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105155,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105156,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105157,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105158,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105159,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105160,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105161,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105162,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105163,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105164,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105165,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105166,'opus' => array(array( 'name' => 'PriPri編集部', 'kana' => 'プリプリヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105167,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105168,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105169,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105170,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105171,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105172,'opus' => array(array( 'name' => 'セントラルメディエンス コミュニケーションズ', 'kana' => 'セントラルメディエンス コミュニケーションズ', 'type' => '編集', ) ), ),
array('id' => 10105173,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105174,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105175,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105176,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105177,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105178,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105179,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105180,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105181,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105182,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105183,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105184,'opus' => array(array( 'name' => '家庭画報編集部', 'kana' => 'カテイガホウヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105185,'opus' => array(array( 'name' => '時計Begin編集部', 'kana' => 'トケイビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105186,'opus' => array(array( 'name' => '時計Begin編集部', 'kana' => 'トケイビギンヘンシュウブ', 'type' => '編集', ) ), ),
array('id' => 10105187,'opus' => array(array( 'name' => '時計Begin編集部', 'kana' => 'トケイビギンヘンシュウブ', 'type' => '編集', ) ), ),

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
//     ～～～
//     ～～～
//   ),
// ),
// ～～～
// ～～～

// $publisher_id = 1125; // 竹書房 pro
// $publisher_id = 1276; // 丸善出版 stg
$publisher_id = 1165; // 世界文化社 pro

/**
* 環境
*/
// $env = 'pro';
// $env = 'stg';
$env = 'docker';

$db = new PDO(tools::getDsn($env), tools::getUser($env), tools::getPassword($env));


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
    $v1['name'] = trim($v1['name']);
    $v1['type'] = trim($v1['type']);
    if(empty($v1['name']) || empty($v1['type'])) {
      // 空の値がある場合は スキップ
      echo "empty data exists bookid {$v['id']} author " . ($k1+1) . "<br>";
      flush();
      ob_flush();
      continue;
    }
    // 半角カタカナ、ひらがなは、全角カタカナへ変換
    $v1['kana'] = trim(mb_convert_kana($v1['kana'], "KC"));
    // カタカナ以外を削除
    $v1['kana'] = mb_ereg_replace('[^ァ-ヶー]', '', $v1['kana']);
    if(empty($v1['kana'])) {
      // 空の場合は半角スペースを設定
      $v1['kana'] = ' ';
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