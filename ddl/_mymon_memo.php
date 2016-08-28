■表示しているコメントについて
・設問回答後のコメント、累計値のコメントはデータベースに入っている。




■データベースへのアクセス方法
・【heteml管理画面】https://admin.heteml.jp/web/db/
　→　mysql512.heteml.jp	_psychologygame　の 「phpmyadmin」をクリック

・【phpmyadmin】下記でログイン。
　ユーザ名: _psychologygame
　パスワード: 88709615p

・【phpmyadmin】左サイドメニュー 「_psychologygame」をクリック

・（※データを修正する際は念のためデータバックアップをとってからのほうが安心です。）
・データバックアップ手順は、「_psychologygame」をクリック、画面上部「エクスポート」リンクを押下後、実行ボタンを押下。

・以下、DB内のテーブル（どのデータが入っているか？）の説明です。
　各テーブルのリンクをクリックし、編集したい行の「編集」リンクを押すと編集画面へ。

M_CHARACTER　・・・　資料「マイモン設計.xlsx」の「結果コメント」シートのコメントになります。
　属性コード 300 → 木
　属性コード 301 → 火
　属性コード 302 → 土
　属性コード 303 → 金
　属性コード 304 → 水

M_HANYO　・・・　各種情報の表示文言
M_PHTEST_BASIC　・・・　属性コードと質問内容
M_PHTEST_GROWTH　・・・　日々の質問
M_TOTALCOMMENT　・・・　累計値毎のコメント。ここはデフォルトのままですので、編集が必要です。
M_USER　・・・　登録されているユーザ情報。※先日ユーザ編集画面に「育成期限」を編集できるようにしましたが、このテーブルでいう「limitdate」を画面から編集できるようにしました。
T_PHTEST_BASIC_HISTORY　・・・　ユーザと過去選択した回答や設問の履歴。
T_PHTEST_GROWTH_HISTORY　・・・　ユーザと過去選択した回答や設問の履歴。
T_PHTEST_PENALTY_HISTORY　・・・　ユーザと過去選択した回答や設問の履歴。
T_PHTEST_RESULT_HISTORY　・・・　ユーザと過去選択した回答や設問の履歴。
T_PHTEST_TOTAL_HISTORY　・・・　ユーザと過去選択した回答や設問の履歴。
T_SURVEY_HISTORY　・・・　ユーザと過去選択した回答や設問の履歴。

