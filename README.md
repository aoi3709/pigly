# アプリケーション名
- pigly

## 環境構築
- docker-compose up -d --build
- docker-compose exec php bash
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan db:seed


## 使用技術(実行環境)
- Laravel Framework:8.83.29
- laravel-mix@6.0.49
- Laravel Fortify
- PHP:8.2.28
- mysql:8.0.26
- node:v18.19.1
- npm:9.2.0


## ER図
![PiGLy ER Diagram](public/images/pigly_ER.png)
※public/images/pigly.drawioにも作成図があります。

## URL
- 開発環境:http://localhost/weight_logs
- phpMyAdmin:http://localhost:8080/index.php?route=/database/structure&db=laravel_db

## 備考
- 各ページのバリデーションエラーについて。Figmaでは一括表示されていますが、一部個別でエラーを確認することで表示できるものや、Figmaでは二文でエラー表示されているが、こちらのエラー確認では一文で一括表示されている箇所があります。個別で確認するとエラーがでます。

- メールアドレスまたは、運動内容入力欄のバリデーションエラー確認時の認識：全ての項目を空欄で送信の場合、『メールアドレスは「ユーザー名@ドメイン」形式で入力してください』 は出ない。メールアドレスが空欄の場合、required が優先されるため。また、「運動内容：120文字以内で入力してください」というエラーWeightLogRequest.php で exercise_content フィールドに nullable ルールが適用されているため出ないという認識です。

- 体重を5桁以上、または少数点2桁以上を入力したときのバリデーションエラー：「4桁までの数字で、小数点は1桁以内にしてください」と1文で出る。
