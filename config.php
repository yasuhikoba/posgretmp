<?php

/**
 * ※ このファイルはコミット対象です。DB接続情報（パスワード等）は .env に記載してください。
 */

/**
 * 出版社ID 対応表
 *
 * 書式: '出版社名' => ['pro' => 本番ID, 'stg' => ステージングID]
 * pro と stg で同一IDの場合は同じ値を設定。
 * 片方にしか存在しない場合は null を設定。
 *
 * 【使い方（各スクリプト内）】
 *   require_once('../config.php');
 *   $env = 'docker';
 *   $publisher_id = PUBLISHER_IDS['慶應義塾大学出版会'][$env];
 */
define('PUBLISHER_IDS', [
  '東京科学同人'       => ['pro' => 20,   'stg' => 20,   'docker' => 20],
  '勁草書房'           => ['pro' => 21,   'stg' => 21,   'docker' => 21],
  '吉川弘文館'         => ['pro' => 24,   'stg' => 24,   'docker' => 24],
  '学陽書房'           => ['pro' => 86,   'stg' => 86,   'docker' => 86],
  '大修館書店'         => ['pro' => 98,   'stg' => 98,   'docker' => 98],
  '日本文芸社'         => ['pro' => 137,  'stg' => 137,  'docker' => 137],
  'LH陽光'             => ['pro' => 177,  'stg' => 177,  'docker' => 177],
  '日刊工業新聞社'     => ['pro' => 1046, 'stg' => 1022, 'docker' => 1022],
  '白夜書房'           => ['pro' => 1084, 'stg' => 1027, 'docker' => 1027],
  '竹書房'             => ['pro' => 1125, 'stg' => null, 'docker' => null],
  '研究社'             => ['pro' => 1163, 'stg' => null, 'docker' => null],
  '世界文化社'         => ['pro' => 1165, 'stg' => 1177, 'docker' => 1177],
  '丸善出版'           => ['pro' => 1203, 'stg' => 1276, 'docker' => 1276],
  '光文社'             => ['pro' => 1204, 'stg' => null, 'docker' => null],
  '創元社'             => ['pro' => 1207, 'stg' => 1313, 'docker' => 1313],
  '国際商業出版'       => ['pro' => null, 'stg' => 1210, 'docker' => 1210],
  '産労総合研究所'     => ['pro' => 1244, 'stg' => 1351, 'docker' => 1351],
  '慶應義塾大学出版会' => ['pro' => 1280, 'stg' => 1349, 'docker' => 1349],
]);
