<?php
class tools
{
  /**
   * [loadEnv]
   * .env ファイルを読み込んで環境変数に設定する
   * （PHPのフレームワークなしでの簡易 .env ローダー）
   *
   * @param [String] $path [.env ファイルのパス（省略時はこのファイルと同じディレクトリ）]
   */
  static function loadEnv($path = null)
  {
    if ($path === null) {
      $path = __DIR__ . '/.env';
    }
    if (!file_exists($path)) {
      throw new \RuntimeException('.env ファイルが見つかりません: ' . $path);
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
      // コメント行はスキップ
      if (strpos(trim($line), '#') === 0) {
        continue;
      }
      // KEY=VALUE 形式のみ処理
      if (strpos($line, '=') === false) {
        continue;
      }
      [$key, $value] = explode('=', $line, 2);
      $key   = trim($key);
      $value = trim($value);
      // 既に設定済みの場合は上書きしない（実行環境の環境変数を優先）
      if (!isset($_ENV[$key]) && getenv($key) === false) {
        putenv("$key=$value");
        $_ENV[$key] = $value;
      }
    }
  }

  /**
   * [convertSearchText]
   * あいまい検索のため、ひらがなはカタカナへ
   * 全角は半角へ、大文字は小文字へ変換
   *
   * @param [String] $search_text [検索文字]
   * @return [String] [変換後文字列]
   */
  static function convertSearchText($search_text)
  {
    $result = preg_replace('/あ|ｱ/', 'ア', $search_text);
    $result = preg_replace('/い|ｲ/', 'イ', $result);
    $result = preg_replace('/う|ゔ|ヴ|ｳﾞ|ｳ/', 'ウ', $result);
    $result = preg_replace('/え|ｴ/', 'エ', $result);
    $result = preg_replace('/お|ｵ/', 'オ', $result);

    $result = preg_replace('/か|が|ガ|ｶﾞ|ｶ/', 'カ', $result);
    $result = preg_replace('/き|ぎ|ギ|ｷﾞ|ｷ/', 'キ', $result);
    $result = preg_replace('/く|ぐ|グ|ｸﾞ|ｸ/', 'ク', $result);
    $result = preg_replace('/け|げ|ゲ|ｹﾞ|ｹ/', 'ケ', $result);
    $result = preg_replace('/こ|ご|ゴ|ｺﾞ|ｺ/', 'コ', $result);

    $result = preg_replace('/さ|ざ|ザ|ｻﾞ|ｻ/', 'サ', $result);
    $result = preg_replace('/し|じ|ジ|ｼﾞ|ｼ/', 'シ', $result);
    $result = preg_replace('/す|ず|ズ|ｽﾞ|ｽ/', 'ス', $result);
    $result = preg_replace('/せ|ぜ|ゼ|ｾﾞ|ｾ/', 'セ', $result);
    $result = preg_replace('/そ|ぞ|ゾ|ｿﾞ|ｿ/', 'ソ', $result);

    $result = preg_replace('/た|だ|ダ|ﾀﾞ|ﾀ/', 'タ', $result);
    $result = preg_replace('/ち|ぢ|ヂ|ﾁﾞ|ﾁ/', 'チ', $result);
    $result = preg_replace('/つ|づ|ヅ|ﾂﾞ|ﾂ/', 'ツ', $result);
    $result = preg_replace('/て|で|デ|ﾃﾞ|ﾃ/', 'テ', $result);
    $result = preg_replace('/と|ど|ド|ﾄﾞ|ﾄ/', 'ト', $result);

    $result = preg_replace('/な|ﾅ/', 'ナ', $result);
    $result = preg_replace('/に|ﾆ/', 'ニ', $result);
    $result = preg_replace('/ぬ|ﾇ/', 'ヌ', $result);
    $result = preg_replace('/ね|ﾈ/', 'ネ', $result);
    $result = preg_replace('/の|ﾉ/', 'ノ', $result);

    $result = preg_replace('/は|ば|ぱ|バ|パ|ﾊﾞ|ﾊﾟ|ﾊ/', 'ハ', $result);
    $result = preg_replace('/ひ|び|ぴ|ビ|ピ|ﾋﾞ|ﾋﾟ|ﾋ/', 'ヒ', $result);
    $result = preg_replace('/ふ|ぶ|ぷ|ブ|プ|ﾌﾞ|ﾌﾟ|ﾌ/', 'フ', $result);
    $result = preg_replace('/へ|べ|ぺ|ベ|ペ|ﾍﾞ|ﾍﾟ|ﾍ/', 'ヘ', $result);
    $result = preg_replace('/ほ|ぼ|ぽ|ボ|ポ|ﾎﾞ|ﾎﾟ|ﾎ/', 'ホ', $result);

    $result = preg_replace('/ま|ﾏ/', 'マ', $result);
    $result = preg_replace('/み|ﾐ/', 'ミ', $result);
    $result = preg_replace('/む|ﾑ/', 'ム', $result);
    $result = preg_replace('/め|ﾒ/', 'メ', $result);
    $result = preg_replace('/も|ﾓ/', 'モ', $result);

    $result = preg_replace('/や|ﾔ/', 'ヤ', $result);
    $result = preg_replace('/ゆ|ﾕ/', 'ユ', $result);
    $result = preg_replace('/よ|ﾖ/', 'ヨ', $result);

    $result = preg_replace('/ら|ﾗ/', 'ラ', $result);
    $result = preg_replace('/り|ﾘ/', 'リ', $result);
    $result = preg_replace('/る|ﾙ/', 'ル', $result);
    $result = preg_replace('/れ|ﾚ/', 'レ', $result);
    $result = preg_replace('/ろ|ﾛ/', 'ロ', $result);

    $result = preg_replace('/わ|ﾜ/', 'ワ', $result);
    $result = preg_replace('/を|ｦ/', 'ヲ', $result);
    $result = preg_replace('/ん|ﾝ/', 'ン', $result);
    $result = preg_replace('/ぁ|ｬ/', 'ァ', $result);
    $result = preg_replace('/ぃ|ｨ/', 'ィ', $result);
    $result = preg_replace('/ぅ|ｩ/', 'ゥ', $result);
    $result = preg_replace('/ぇ|ｪ/', 'ェ', $result);
    $result = preg_replace('/ぉ|ｫ/', 'ォ', $result);
    $result = preg_replace('/っ|ｯ/', 'ッ', $result);
    $result = preg_replace('/ゃ|ｬ/', 'ャ', $result);
    $result = preg_replace('/ゅ|ｭ/', 'ュ', $result);
    $result = preg_replace('/ょ|ｮ/', 'ョ', $result);

    $result = preg_replace('/｡|｢|｣|､|･|ｰ|－|。|「|」|、|・|ー|-|　| |・|:|：/', '', $result);

    $result = mb_convert_kana($result, "rn");
    $result = strtolower($result);

    return $result;
  }

  /**
   * [getDsn]
   * PostgreSQLへの接続に必要な文字列 dsnを返す
   * 接続情報は .env ファイルから取得します。
   *
   * @param [String] $env [pro or stg or docker]
   * @return [String] [dsn]
   */
  static function getDsn($env)
  {
    $prefix = strtoupper($env);
    $host   = getenv("{$prefix}_DB_HOST");
    $port   = getenv("{$prefix}_DB_PORT") ?: '5432';
    $dbname = getenv("{$prefix}_DB_NAME");
    return "pgsql:dbname={$dbname};host={$host};port={$port}";
  }

  /**
   * [getUser]
   * PostgreSQLへの接続に必要な文字列 ユーザー名を返す
   * 接続情報は .env ファイルから取得します。
   *
   * @param [String] $env [pro or stg or docker]
   * @return [String] [user]
   */
  static function getUser($env)
  {
    $prefix = strtoupper($env);
    return getenv("{$prefix}_DB_USER");
  }

  /**
   * [getPassword]
   * PostgreSQLへの接続に必要な文字列 パスワードを返す
   * 接続情報は .env ファイルから取得します。
   *
   * @param [String] $env [pro or stg or docker]
   * @return [String] [password]
   */
  static function getPassword($env)
  {
    $prefix = strtoupper($env);
    return getenv("{$prefix}_DB_PASSWORD");
  }
}
