#勤怠管理アプリ
ログイン機能と打刻機能を実装したアプリ

##作成した目的
ログイン機能実装、いままでの学習内容の復習のため

##アプリケーションURL
local

##他のリポジトリ
なし

##機能一覧
-ログイン機能
-新規登録機能
-勤務時間打刻機能
-勤怠情報確認ページ
-個人用勤怠情報確認ページ

##使用技術
php:8.1.1
laravel:8.83.27
nginx:1.21.1
mysql:8.0.26

##テーブル設計図

https://github.com/kuni9997/Attend-sys-test/issues/4#issue-1746673855



##ER図

https://github.com/kuni9997/Attend-sys-test/issues/6#issue-1777778205

#環境構築
Dockerで本番環境と開発環境を切り分けて構築

それぞれのコマンドでコンテナを　起動

本番環境
docker compose -f docker-compose-prod.yaml up -d

開発環境
docker compose -f docker-compose-dev.yaml up -d
