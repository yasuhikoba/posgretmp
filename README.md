
HONDANA＋ のHeroku上のPostgreSQLへ接続し、
クエリを実行するためのものです。

100ループごとに画面に出力します。
（タイムアウトにならないはず。）


# 書誌データの取り込み

竹書房で対応

S:\マイドライブ\hondana\_HONDANA＋\開発中のメモ\TAKESHOBO-1 【竹書房】書誌データ取り込み

世界文化社でさらに完成度が上がる

S:\マイドライブ\hondana\sekaibunka_世界文化社\SEKAIBUNKA_DEV-7 書誌データ関連


項目の並び順が同じか確認は必要

## 対応の流れ

1. 上記を元にSQLを生成し、booksへレコードを追加する
1. CU列を貼り付けて＋コピーして、seach_name の配列部分に貼り付け、出版社IDを確認の上、Docker起動し、ページにアクセスする
1. 実行結果をコピーし `||` をタブに置換して、ExcelのDA2に貼り付け
1. DD列にはみ出していないことを確認の上、著者、ジャンル、シリーズの流し込みを行う
1. フォーマットの流し込みは注意が必要（いろいろ成約があったはず）
1. setbooksearchname を実行する
1. bookCount再計算
1. 日付の調整


## bookCount再計算

出版社IDを指定して実行する

実行前に 0にしておく必要がある

```
update genres set public_books_count = 0 where publisher_id = ＊＊＊;
update series set public_books_count = 0 where publisher_id = ＊＊＊;
update authors set public_books_count = 0 where publisher_id = ＊＊＊;
update authors set books_count = 0 where publisher_id = ＊＊＊;

heroku login
heroku run bash --app hondana-t-cms

rails c

BookGenre.joins(:book).where(books: { public_status: 'public',publisher_id: ＊＊＊ }).find_each do |bg|
bg.genre.self_and_ancestors.update_all('public_books_count = public_books_count + 1',)
end

BookSeries.joins(:book).where(books: { public_status: 'public',publisher_id: ＊＊＊ }).find_each do |bs|
bs.series.self_and_ancestors.update_all('public_books_count = public_books_count + 1',)
end

Opus.joins(:book).where(books: { public_status: 'public',publisher_id: ＊＊＊ }).find_each do |bs|
bs.author.update(public_books_count: bs.author.public_books_count + 1)
end

Opus.joins(:book).where(books: { publisher_id: ＊＊＊ }).find_each do |bs|
bs.author.update(books_count: bs.author.books_count + 1)
end

exit
```

## 日付の調整

JSTで流し込むため、9時間ずれてしまう。  
  
サイトや管理画面の表示上 問題ないものの、日付指定検索にはヒットしなくなってしまう。  
  
下記で確認の上、一括更新を行う

```
select id,publisher_id,name,book_date,release_date,public_date from books where publisher_id = ＊＊＊ and to_char(book_date,'yyyy-mm-dd HH24:MI:SS') like ('%00:00:00');
select id,publisher_id,name,book_date,release_date,public_date from books where publisher_id = ＊＊＊ and to_char(release_date,'yyyy-mm-dd HH24:MI:SS') like ('%00:00:00');
select id,publisher_id,name,book_date,release_date,public_date from books where publisher_id = ＊＊＊ and to_char(public_date,'yyyy-mm-dd HH24:MI:SS') like ('%00:00:00');

update books set book_date = (book_date - '9 hour'::interval) where publisher_id = ＊＊＊ and to_char(book_date,'yyyy-mm-dd HH24:MI:SS') like ('%00:00:00');
update books set release_date = (release_date - '9 hour'::interval) where publisher_id = ＊＊＊ and to_char(release_date,'yyyy-mm-dd HH24:MI:SS') like ('%00:00:00');
update books set public_date = (public_date - '9 hour'::interval) where publisher_id = ＊＊＊ and to_char(public_date,'yyyy-mm-dd HH24:MI:SS') like ('%00:00:00');
```

↓↓↓↓↓↓↓  
  
取り込み時点で9時間ずらすようにできる  
  
ただし、  
20241024ではなく  
2024/10/24  
とする必要がある  
「出版年月日」「書店発売日」  
は変換する必要あり  

## 変換項目

```
◯判型
none: 0, # 未選択
shiroku: 1, # 4-6
shirokuhen: 2, # 4-6変
b6: 3, # B6
b6hen: 4, # B6変
a5: 5, # A5
a5hen: 6, # A5変
bunko: 7, # 文庫
shinsho: 8, # 新書
b5: 9, # B5
b5hen: 10, # B5変
a4: 11, # A4
a4hen: 12, # A4変
a6: 13, # A6
a6hen: 14, # A6変
ab: 15, # AB
b7: 21, # B7
b4: 16, # B4
kikuban: 17, # 菊判
kikubaiban: 18, # 菊倍判
kikubanhen: 19, # 菊判変
other: 20, # その他・規格外


◯公開の状態

非公開 0
公開 1
予約公開 2


◯在庫設定

none: 0, # 未選択
in_stock: 1, #在庫あり
short: 2, #在庫僅少
reprinting: 3, #重版中
reservation: 4, #未刊・予約受付中
out_of_stock: 5, #品切れ・重版未定
out_of_print: 6, #絶版
ondemand: 7, #オンデマンド制作


◯出版年月日、書店発売日、予約公開日

20241024
↓
2024/10/24  

Excelの書式設定で、必ず「文字列」にしてから貼り付ける


◯新刊設定
TRUE
FALSE
→ Excelで対応

◯これから出る本設定

TRUE
FALSE
→ Excelで対応

◯おすすめ設定

TRUE
FALSE
→ Excelで対応

◯カート設定

TRUE
FALSE
→ Excelで対応

◯電子書籍設定

TRUE
FALSE
→ Excelで対応

```


# お知らせデータの取り込み

丸善出版を参考にする
S:\マイドライブ\hondana\maruzen-丸善出版\MARUZEN_RN_DEV-6 おしらせ記事データの取込(STG)

特に日付の変換部分を行わないと9時間ずれて登録されてしまう
