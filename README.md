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

※このコマンドは **php コンテナ内**で実行してください。

### php コンテナに入る方法

```bash
docker-compose exec php bash
```

※ コンテナから抜けるときは exit を入力してください。

## 6. マイグレーションの実行

データベースにテーブルを作成します。

このコマンドも **php コンテナ内**で実行してください。

```bash
php artisan migrate
```

## 7. シーディングの実行

初期データを投入します。

このコマンドも **php コンテナ内**で実行してください。

```bash
php artisan db:seed
```

## 8. ストレージのシンボリックリンク作成

画像やファイルを storage/app/public から公開できるようにリンクを作成します。

このコマンドも **php コンテナ内**で実行してください。

```bash
php artisan storage:link

###  View ファイルの作成
 resources/views/layouts/common_white.blade.php（共通レイアウト）
resources/views/layouts/common_pink.blade.php（共通レイアウト）
resources/views/weight_logs/index.blade.php(トップページ管理画面）

## CSS ファイルの作成
public/css/common_white.css(共通 CSS)
public/css/common_pink.css(共通 CSS)
public/css/dashboard.css（トップページ管理画面）

```

