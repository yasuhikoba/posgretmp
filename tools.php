<?php
class tools {
  /**
  * [convertSearchText]
  * あいまい検索のため、ひらがなはカタカナへ
  * 全角は半角へ、大文字は小文字へ変換
  *
  * @param [String] $search_text [検索文字]
  * @return [String] [変換後文字列]
  */
  static function convertSearchText($search_text) {
    $result = preg_replace('/あ|ｱ/', 'ア',$search_text);
    $result = preg_replace('/い|ｲ/', 'イ',$result);
    $result = preg_replace('/う|ゔ|ヴ|ｳﾞ|ｳ/', 'ウ',$result);
    $result = preg_replace('/え|ｴ/', 'エ',$result);
    $result = preg_replace('/お|ｵ/', 'オ',$result);

    $result = preg_replace('/か|が|ガ|ｶﾞ|ｶ/', 'カ',$result);
    $result = preg_replace('/き|ぎ|ギ|ｷﾞ|ｷ/', 'キ',$result);
    $result = preg_replace('/く|ぐ|グ|ｸﾞ|ｸ/', 'ク',$result);
    $result = preg_replace('/け|げ|ゲ|ｹﾞ|ｹ/', 'ケ',$result);
    $result = preg_replace('/こ|ご|ゴ|ｺﾞ|ｺ/', 'コ',$result);

    $result = preg_replace('/さ|ざ|ザ|ｻﾞ|ｻ/', 'サ',$result);
    $result = preg_replace('/し|じ|ジ|ｼﾞ|ｼ/', 'シ',$result);
    $result = preg_replace('/す|ず|ズ|ｽﾞ|ｽ/', 'ス',$result);
    $result = preg_replace('/せ|ぜ|ゼ|ｾﾞ|ｾ/', 'セ',$result);
    $result = preg_replace('/そ|ぞ|ゾ|ｿﾞ|ｿ/', 'ソ',$result);

    $result = preg_replace('/た|だ|ダ|ﾀﾞ|ﾀ/', 'タ',$result);
    $result = preg_replace('/ち|ぢ|ヂ|ﾁﾞ|ﾁ/', 'チ',$result);
    $result = preg_replace('/つ|づ|ヅ|ﾂﾞ|ﾂ/', 'ツ',$result);
    $result = preg_replace('/て|で|デ|ﾃﾞ|ﾃ/', 'テ',$result);
    $result = preg_replace('/と|ど|ド|ﾄﾞ|ﾄ/', 'ト',$result);

    $result = preg_replace('/な|ﾅ/', 'ナ',$result);
    $result = preg_replace('/に|ﾆ/', 'ニ',$result);
    $result = preg_replace('/ぬ|ﾇ/', 'ヌ',$result);
    $result = preg_replace('/ね|ﾈ/', 'ネ',$result);
    $result = preg_replace('/の|ﾉ/', 'ノ',$result);

    $result = preg_replace('/は|ば|ぱ|バ|パ|ﾊﾞ|ﾊﾟ|ﾊ/', 'ハ',$result);
    $result = preg_replace('/ひ|び|ぴ|ビ|ピ|ﾋﾞ|ﾋﾟ|ﾋ/', 'ヒ',$result);
    $result = preg_replace('/ふ|ぶ|ぷ|ブ|プ|ﾌﾞ|ﾌﾟ|ﾌ/', 'フ',$result);
    $result = preg_replace('/へ|べ|ぺ|ベ|ペ|ﾍﾞ|ﾍﾟ|ﾍ/', 'ヘ',$result);
    $result = preg_replace('/ほ|ぼ|ぽ|ボ|ポ|ﾎﾞ|ﾎﾟ|ﾎ/', 'ホ',$result);

    $result = preg_replace('/ま|ﾏ/', 'マ',$result);
    $result = preg_replace('/み|ﾐ/', 'ミ',$result);
    $result = preg_replace('/む|ﾑ/', 'ム',$result);
    $result = preg_replace('/め|ﾒ/', 'メ',$result);
    $result = preg_replace('/も|ﾓ/', 'モ',$result);

    $result = preg_replace('/や|ﾔ/', 'ヤ',$result);
    $result = preg_replace('/ゆ|ﾕ/', 'ユ',$result);
    $result = preg_replace('/よ|ﾖ/', 'ヨ',$result);

    $result = preg_replace('/ら|ﾗ/', 'ラ',$result);
    $result = preg_replace('/り|ﾘ/', 'リ',$result);
    $result = preg_replace('/る|ﾙ/', 'ル',$result);
    $result = preg_replace('/れ|ﾚ/', 'レ',$result);
    $result = preg_replace('/ろ|ﾛ/', 'ロ',$result);

    $result = preg_replace('/わ|ﾜ/', 'ワ',$result);
    $result = preg_replace('/を|ｦ/', 'ヲ',$result);
    $result = preg_replace('/ん|ﾝ/', 'ン',$result);
    $result = preg_replace('/ぁ|ｬ/', 'ァ',$result);
    $result = preg_replace('/ぃ|ｨ/', 'ィ',$result);
    $result = preg_replace('/ぅ|ｩ/', 'ゥ',$result);
    $result = preg_replace('/ぇ|ｪ/', 'ェ',$result);
    $result = preg_replace('/ぉ|ｫ/', 'ォ',$result);
    $result = preg_replace('/っ|ｯ/', 'ッ',$result);
    $result = preg_replace('/ゃ|ｬ/', 'ャ',$result);
    $result = preg_replace('/ゅ|ｭ/', 'ュ',$result);
    $result = preg_replace('/ょ|ｮ/', 'ョ',$result);

    $result = preg_replace('/｡|｢|｣|､|･|ｰ|－|。|「|」|、|・|ー|-|　| |・|:|：/', '',$result);

    $result = mb_convert_kana($result, "rn");
    $result = strtolower($result);

    return $result;
  }

  /**
  * [getDsn]
  * PostgreSQLへの接続に必要な文字列 dsnを返す
  *
  * @param [String] $env [pro or stg or その他]
  * @return [String] [dsn]
  */
  static function getDsn($env) {
    $response = null;
    if($env == 'pro') {
      // 本番
      $response = 'pgsql:dbname=d3uldjpkj3ctch;host=ec2-52-204-191-143.compute-1.amazonaws.com;port=5432';
    } elseif($env == 'stg') {
      // STG
      $response = 'pgsql:dbname=ddoo2bus5args;host=ec2-98-85-195-1.compute-1.amazonaws.com;port=5432';
    } else {
      // Docker
      $response = 'pgsql:dbname=app_development;host=172.20.254.227;port=15432';
    }
    return $response;
  }

  /**
  * [getUser]
  * PostgreSQLへの接続に必要な文字列 ユーザー名を返す
  *
  * @param [String] $env [pro or stg or その他]
  * @return [String] [user]
  */
  static function getUser($env) {
    $response = null;
    if($env == 'pro') {
      // 本番
      $response = 'u79urs9of0un6s';
    } elseif($env == 'stg') {
      // STG
      $response = 'u7nngbeo591nrg';
    } else {
      // Docker
      $response = 'postgres';
    }
    return $response;
  }

  /**
  * [getPassword]
  * PostgreSQLへの接続に必要な文字列 パスワードを返す
  *
  * @param [String] $env [pro or stg or その他]
  * @return [String] [password]
  */
  static function getPassword($env) {
    $response = null;
    if($env == 'pro') {
      // 本番
      $response = 'p34d02ab02bf28b14e66b09bc464b4b3e75840bfa9418dba10202fbe1840f91ec';
    } elseif($env == 'stg') {
      // STG
      $response = 'p7d56a26a9669d4853f25806216d58757cafe3806da207e1444226e84e56eef5f';
    } else {
      // Docker
      $response = 'password';
    }
    return $response;
  }
}

?>