# weight-logs-test3

### 概要　

確認テスト 3 回目：Laravel を用いた体重ログ管理アプリの提出用プロジェクトです。

---

### 🛠️ 環境構築手順

## 1. リポジトリの設定

このリポジトリを clone してください。

```bash
cd coachtech/laravel
git clone https://github.com/megumi2233/weight-logs-test3.git
cd weight-logs-test3
```

## 2. Docker の設定

ローカル環境に必要なサービス（nginx, php, mysql, phpMyAdmin）を Docker で構築・起動します。

事前に Docker Desktop を起動し、クジラ 🐳 アイコンが表示されていることを確認してください。

以下のコマンドで Docker 環境を構築・起動します。

```bash
docker-compose up -d --build
```

コンテナが立ち上がれば成功です。

## 3. Laravel のパッケージのインストール

Laravel の動作に必要な依存パッケージをインストールします。

```bash
docker-compose exec php bash
cd /var/www/html
composer install
```

## 4. .env ファイルの作成

Laravel の環境設定を行うために、`.env.example` をコピーして `.env` ファイルを作成します。

```bash
cp .env.example .env
```

※ .env.example を参考に新しく .env を作成しても構いません。

.env の DB 設定を以下のように修正して、DB 接続情報や APP_KEY などの環境変数を設定します。

```Env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

## 5. アプリケーションキーの生成

アプリケーションを起動するためのキーを生成します。

```bash
php artisan key:generate
```

※このコマンドは **php コンテナ内のプロジェクトルート**で実行してください。

### php コンテナに入ってプロジェクトルートへ移動する方法

```bash
docker-compose exec php bash
cd /var/www/html
```

※ コンテナから抜けるときは exit を入力してください。

## 6. マイグレーションの実行

データベースにテーブルを作成します。

このコマンドも **php コンテナ内のプロジェクトルート**で実行してください。

```bash
php artisan migrate
```

## 7. シーディングの実行

初期データを投入します。

このコマンドも **php コンテナ内のプロジェクトルート**で実行してください。

```bash
php artisan db:seed
```

## 8. ストレージのシンボリックリンク作成

画像やファイルを storage/app/public から公開できるようにリンクを作成します。

このコマンドも **php コンテナ内のプロジェクトルート**で実行してください。

```bash
php artisan storage:link
```
---

###  View ファイルの作成
 resources/views/layouts/common_white.blade.php（共通レイアウト「ホワイト系」）
resources/views/layouts/common_pink.blade.php（共通レイアウト「ピンク系」）
resources/views/weight_logs/index.blade.php(トップページ管理画面）
resources/views/goal/goal_setting.blade.php(目標設定画面）
resources/views/weight_logs/search.blade.php（検索画面）
resources/views/weight_logs/show.blade.php(体重詳細画面)
resources/views/weight_logs/create.blade.php(体重登録画面)
resources/views/weight_logs/modal_create.blade.php(体重登録画面　モーダル表示時)
resources/views/register/step1.blade.php（会員登録画面）
resources/views/auth/login.blade.php（ログイン画面）
resources/views/register/step2.blade.php(初期目標体重登録画面)

---

## CSS ファイルの作成
public/css/common_white.css(共通 CSS「ホワイト系」)
public/css/common_pink.css(共通 CSS「ピンク系」)
public/css/dashboard.css（トップページ管理画面）
public/css/goal_setting.css（目標設定画面）
public/css/search.css（検索画面）
public/css/show.css(体重詳細画面)
public/css/weight_create.css(体重登録画面)
public/css/weight_modal.css(体重登録画面　モーダル表示時)
public/css/register_step1.css（会員登録画面）
public/css/login.css（ログイン画面）
public/css/register_step2.css(初期目標体重登録画面)

---

### 🌐 ローカル環境での確認用URL
- アプリケーション: [http://localhost/weight_logs](http://localhost/weight_logs)
  → トップページ管理画面が表示されます
- phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)
  → DB 接続確認やテーブル内容の確認が可能です

---

### 補足：
`weight_target` テーブルの `current_weight` カラムについて 仕様書（テーブル定義）には `current_weight` の記載はありませんが、画面仕様（PG09 初期体重登録画面）およびバリデーション定義（FN008〜FN009）において「現在の体重」の入力項目が存在するため、整合性を保つ目的で `weight_target` テーブルに `current_weight` カラムを追加しています。
このカラムは以下の目的で使用されます： 
- STEP2画面（初期目標体重登録画面）でユーザーが入力した「現在の体重」の保存先として使用
- 管理画面（PG01）上部の「最新体重」と「目標まで」（最新体重 - 目標体重）の表示に使用（登録初期時）
- 将来的に「初期体重 → 最新体重 → 目標体重」の進捗表示やグラフ描画に活用可能 - 画面仕様とDB設計の対応関係を明確にし、レビュー時の混乱を防止
- ※仕様書との差分については、画面仕様および管理画面UIに準拠した設計判断として記載しています。
- ※なお、管理画面（PG01）では `current_weight` は直接表示されませんが、初期登録時の「最新体重」として扱われるため、進捗計算の初期値として保存しています。 　

