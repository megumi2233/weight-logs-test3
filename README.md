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
- アプリケーション: [http://localhost/login](http://localhost/login)
  → ログイン画面が表示されます
  
  ログイン情報（ダミーアカウント）　email: dummy@example.com
　　　　　　　　password: password
  
- phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)
  → DB 接続確認やテーブル内容の確認が可能です

---

### 会員登録時のメールアドレス制約について

- `users` テーブルの `email` カラムには **ユニーク制約** を付与しています。  
  - Laravelの認証機能ではメールアドレスをキーにログインするため、同じメールアドレスを複数ユーザーに許可すると認証判定ができなくなるためです。  
  - マイグレーションファイル `create_users_table.php` にて以下のように定義しています：

    ```php
    $table->string('email')->unique();
    ```

- この制約により、同じメールアドレスで再度登録しようとするとDBレベルでエラーになります。  
- ユーザーに分かりやすく伝えるため、`RegisterAccountRequest` に以下のバリデーションルールを追加しました：

    ```php
    'email' => ['required', 'email', 'unique:users,email'],
    ```

- さらに、エラーメッセージを日本語でカスタマイズしています：

    ```php
    'email.unique' => 'このメールアドレスはすでに登録されています',
    ```

これにより、ユーザーは重複登録を試みた際に **「このメールアドレスはすでに登録されています」** と表示され、  
エラー画面ではなく、フォーム上で分かりやすく修正できるようになっています。

---

## 認証後の遷移先について

Laravelの既定では、ログイン後に `/home` にリダイレクトされる仕様となっています。しかし本アプリケーションでは `/home` ルートを使用しておらず、テスト指示書に従い `/weight_logs` をトップページとして設計しています。

そのため、以下の対応を行っています：

- `LoginController.php` にて `$redirectTo = '/weight_logs'` を明示
- `RouteServiceProvider::HOME` を `/weight_logs` に変更
- 万が一 `/home` にアクセスされた場合の保険として、`/home` → `/weight_logs` のリダイレクトルートを追加

```php
Route::get('/home', function () {
    return redirect('/weight_logs');
});
 ```

---

### current_weight カラム追加の設計意図：
`weight_target` テーブルの `current_weight` カラムについて 仕様書（テーブル定義）には `current_weight` の記載はありませんが、画面仕様（PG09 初期体重登録画面）およびバリデーション定義（FN008〜FN009）において「現在の体重」の入力項目が存在するため、整合性を保つ目的で `weight_target` テーブルに `current_weight` カラムを追加しています。
このカラムは以下の目的で使用されます： 
- STEP2画面（初期目標体重登録画面）でユーザーが入力した「現在の体重」の保存先として使用
- 管理画面（PG01）上部の「最新体重」と「目標まで」（最新体重 - 目標体重）の表示に使用
  
  （登録初期時に使用します。
  　管理画面の「最新体重」を表示する際に、weight_logs が空なら weight_target の current_weight を使い、weight_logs にデータがあるなら最新の日付の weight を使います。）
- 将来的に「初期体重 → 最新体重 → 目標体重」の進捗表示やグラフ描画に活用可能
- 画面仕様とDB設計の対応関係を明確にし、レビュー時の混乱を防止
  
 ※仕様書との差分については、画面仕様および管理画面UIに準拠した設計判断として記載しています。
 ※なお、管理画面（PG01）では `current_weight` は直接表示されませんが、初期登録時の「最新体重」として扱われるため、進捗計算の初期値として保存しています。

 ---

### 認証ミドルウェアによるアクセス制限と一時的な解除について

管理画面（PG01）を含む体重ログ関連の画面は、ログイン済みのユーザーのみがアクセスできるように設計しています。

`WeightLogController` に `auth` ミドルウェアを追加することで、未ログイン状態でアクセスされた場合は自動的にログイン画面へリダイレクトされ、エラーを防止しています。

```php
public function __construct()
{
    $this->middleware('auth');
}
 ```

`ただし、/weight_logs/goal_setting` の画面については **ログイン済みでも `404 Not Found` になる**ため、レビュー確認用として一時的に `auth` ミドルウェアを解除しています。

これは Laravel のルーティング仕様により、`/weight_logs/{weightLog}` のルートが先に評価されることで、`goal_setting` が存在しない ID として解釈されてしまうためです。

そのためレビュー確認用として、一時的に `auth` ミドルウェアを解除し、画面表示と更新処理を可能にしています。 

本来はログイン後に表示される画面ですが、提出時点での動作確認を優先し、画面表示と更新処理を可能にするための暫定対応です。

提出後は `auth` ミドルウェアを元に戻すことで、正しい認証制御が可能です。
  
Laravel のルートを変更した場合は、以下を必ず実行してください：

```bash
php artisan route:clear
php artisan config:clear
 ```

---

— ローカル環境をリセットしてマイグレーション＆シードを再実行する手順
概要
この手順は、ローカルでマウントしている MySQL データや Laravel のキャッシュ・ログを安全に削除し、クリーンな状態でマイグレーションとシードを実行するための手順です。操作は不可逆なので、必要なら事前にバックアップを必ず取得してください。

前提
あなたはプロジェクトのルートディレクトリにいること（例: ~/coachtech/laravel/weight-logs-test3）

Docker / docker-compose を利用している環境を想定

操作でデータは消える（バックアップを取ること）

バックアップ（任意だが推奨）
MySQL データを残したい場合はコンテナ内からダンプを取得します（例）:

bash
# mysql コンテナ名を確認してから
docker-compose ps
docker exec -it <mysql_container_name> bash
mysqldump -u root -p <database_name> > /tmp/backup.sql
# ホストへコピーする場合
docker cp <mysql_container_name>:/tmp/backup.sql ./backup.sql

手順（順に実行）
コンテナ停止

bash
docker-compose down
ホスト上でマウントされた MySQL データを削除（安全に所有権を付け替えてから削除）

bash
# プロジェクトルートで実行
sudo chown -R $(id -u):$(id -g) ./docker/mysql/data
rm -rf ./docker/mysql/data

Laravel のストレージ／キャッシュをホスト側でリセット

bash
sudo chown -R $(id -u):$(id -g) storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
コンテナ再起動（バックグラウンド）

bash
docker-compose up -d

マイグレーションとシードを実行（php コンテナ内または docker-compose exec で）

bash
# ホストから
docker-compose exec php php artisan migrate:fresh --seed

# またはコンテナ内に入ってから
docker-compose exec php bash
cd /var/www/html
php artisan migrate:fresh --seed

シード確認（Tinker でユーザー存在チェック）

bash
# コンテナ内で
php artisan tinker
>>> \App\Models\User::where('email','dummy@example.com')->exists()
>>> exit
true が返ればシード成功

トラブルシューティング（よくある問題と対処）
Permission denied（storage/logs/laravel.log 等）

ホスト側で:

bash
sudo chown -R $(id -u):$(id -g) storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
コンテナ内で（root 権限時）:

bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
docker-compose restart

シードが効かない（ユーザーが見つからない）

migrate:fresh --seed の実行ログにエラーがないか確認し、エラーがあれば全文を保存して調査する

削除できないファイル（Permission denied）

docker-compose down を実行後に sudo chown で所有権を変更してから rm -rf を実行する

cat >> README.md <<'README_BLOCK'

### ローカル環境リセット — マイグレーション＆シード再実行手順

この手順は、ローカルでマウントしている MySQL データや Laravel のキャッシュ・ログを安全に削除し、クリーンな状態でマイグレーションとシードを実行するための手順です。操作は不可逆です。必要なら事前にバックアップを必ず取得してください。

---

<details>
<summary>前提（クリックで展開）</summary>

- プロジェクトのルートディレクトリにいること（例: ~/coachtech/laravel/weight-logs-test3）  
- Docker / docker-compose を利用している環境を想定  
- この操作でデータは消えます（バックアップ必須）  
</details>

---

<details>
<summary>バックアップ（任意だが推奨）</summary>

- MySQL データを残したい場合はコンテナ内からダンプを取得します（例）:

```bash
# mysql コンテナ名を確認してから
docker-compose ps
docker exec -it <mysql_container_name> bash
mysqldump -u root -p <database_name> > /tmp/backup.sql

# ホストへコピーする場合
docker cp <mysql_container_name>:/tmp/backup.sql ./backup.sql

</details>
#!/usr/bin/env bash
set -euo pipefail

# 確認プロンプト
read -p "この操作はデータを消します。本当に続行しますか？ (yes/no): " confirm
if [ "$confirm" != "yes" ]; then
  echo "中止しました"
  exit 1
fi

# 1. コンテナ停止
echo "1/7: docker-compose down を実行します..."
docker-compose down

# 2. ホスト上でマウントされた MySQL データを削除（安全に所有権を付け替えてから削除）
MYSQL_DATA_DIR="./docker/mysql/data"
if [ -d "$MYSQL_DATA_DIR" ]; then
  echo "2/7: 所有権を変更して $MYSQL_DATA_DIR を削除します..."
  sudo chown -R "$(id -u):$(id -g)" "$MYSQL_DATA_DIR"
  rm -rf "$MYSQL_DATA_DIR"
else
  echo "2/7: $MYSQL_DATA_DIR が見つかりません。スキップします。"
fi

# 3. Laravel のストレージ／キャッシュをホスト側でリセット
echo "3/7: storage と bootstrap/cache の所有権とパーミッションを修正します..."
sudo chown -R "$(id -u):$(id -g)" storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

# 4. コンテナ再起動（バックグラウンド）
echo "4/7: docker-compose up -d を実行します..."
docker-compose up -d

# 5. マイグレーションとシードを実行（php コンテナ経由）
echo "5/7: php artisan migrate:fresh --seed を実行します..."
docker-compose exec php php artisan migrate:fresh --seed

# 6. シード確認（Tinker を使って存在チェック）
echo "6/7: シード結果を確認します（dummy@example.com の存在をチェック）..."
EXISTS=$(docker-compose exec -T php php artisan tinker --execute="echo \App\Models\User::where('email','dummy@example.com')->exists() ? 'true' : 'false';")
echo "ユーザー存在チェック: $EXISTS"

# 7. 最後の案内
echo "7/7: 完了しました。ブラウザでログイン画面を確認してください（例: http://localhost/login）。"
echo "ダミー認証: email=dummy@example.com password=password"

exit 0


