# weight-logs-test3

### 概要　

確認テスト 3 回目：Laravel を用いた体重ログ管理アプリの提出用プロジェクトです。

---

### 🛠️ 環境構築手順

#### 1. リポジトリの設定

このリポジトリを clone してください。

```bash
cd coachtech/laravel
git clone https://github.com/megumi2233/weight-logs-test3.git
cd weight-logs-test3
```

#### 2. Docker の設定

ローカル環境に必要なサービス（nginx, php, mysql, phpMyAdmin）を Docker で構築・起動します。

事前に Docker Desktop を起動し、クジラ 🐳 アイコンが表示されていることを確認してください。

以下のコマンドで Docker 環境を構築・起動します。

```bash
docker-compose up -d --build
```

コンテナが立ち上がれば成功です。

#### 3. Laravel のパッケージのインストール

Laravel の動作に必要な依存パッケージをインストールします。

```bash
docker-compose exec php bash
cd /var/www/html
composer install
exit
```

#### 4. .env ファイルの作成

Laravel の環境設定を行うために、`.env.example` をコピーして `.env` ファイルを作成します。

```bash
cp .env.example .env
```

※ .env.example を参考に新しく .env を作成しても構いません。

.env の DB 設定を以下のように修正して、DB 接続情報や APP_KEY などの環境変数を設定します。

```ini
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

#### 5. アプリケーションキーの生成

アプリケーションを起動するためのキーを生成します。

```bash
php artisan key:generate
```

※このコマンドは **php コンテナ内のプロジェクトルート**で実行してください。

##### php コンテナに入ってプロジェクトルートへ移動する方法

```bash
docker-compose exec php bash
cd /var/www/html
```

※ コンテナから抜けるときは exit を入力してください。

#### 6. マイグレーションの実行

データベースにテーブルを作成します。

このコマンドも **php コンテナ内のプロジェクトルート**で実行してください。

```bash
php artisan migrate
```

#### 7. シーディングの実行

初期データを投入します。

このコマンドも **php コンテナ内のプロジェクトルート**で実行してください。

```bash
php artisan db:seed
```

#### 8. ストレージのシンボリックリンク作成

画像(詳細画面にあるゴミ箱マーク)やファイルを storage/app/public から公開できるようにリンクを作成します。

このコマンドも **php コンテナ内のプロジェクトルート**で実行してください。

```bash
php artisan storage:link
```

---

### 🧩 View ファイルの作成

#### 共通レイアウト
- resources/views/layouts/common_white.blade.php（ホワイト系）
- resources/views/layouts/common_pink.blade.php（ピンク系）

#### 体重ログ関連
- resources/views/weight_logs/index.blade.php（トップページ管理画面）
- resources/views/weight_logs/search.blade.php（検索画面）
- resources/views/weight_logs/show.blade.php（体重詳細画面）
- resources/views/weight_logs/create.blade.php（体重登録画面）
- resources/views/weight_logs/modal_create.blade.php（体重登録画面 モーダル表示時）

#### 会員登録・認証関連
- resources/views/register/step1.blade.php（会員登録画面）
- resources/views/auth/login.blade.php（ログイン画面）
- resources/views/register/step2.blade.php（初期目標体重登録画面）

#### 目標設定
- resources/views/goal/goal_setting.blade.php（目標設定画面）

---

### 🎨 CSS ファイルの作成

#### 共通レイアウト
- public/css/common_white.css（ホワイト系）
- public/css/common_pink.css（ピンク系）

#### 体重ログ関連
- public/css/dashboard.css（トップページ管理画面）
- public/css/search.css（検索画面）
- public/css/show.css（体重詳細画面）
- public/css/weight_create.css（体重登録画面）
- public/css/weight_modal.css（体重登録画面 モーダル表示時）

#### 会員登録・認証関連
- public/css/register_step1.css（会員登録画面）
- public/css/login.css（ログイン画面）
- public/css/register_step2.css（初期目標体重登録画面）

#### 目標設定
- public/css/goal_setting.css（目標設定画面）

---

### 🛠 使用技術（この例で使われている環境）
- **PHP 8.2**  
- **Laravel 10.x**  
- **MySQL 8.0.x**  
- **Docker（開発環境構築）**  
  - nginx（Webサーバ）  
  - php（アプリケーション）  
  - mysql（データベース）  
  - phpmyadmin（DB管理ツール）  
- **フロントエンドビルド**: Vite（Laravel公式推奨のビルドツール）

---

### 📋 テーブル設計
## usersテーブル

| カラム名     | 型               | PRIMARY KEY | NOT NULL | FOREIGN KEY |
|--------------|------------------|-------------|-----------|--------------|
| id           | bigint unsigned  | ○           | ○         |              |
| name         | varchar(255)     |             | ○         |              |
| email        | varchar(255)     |             | ○         |              |
| password     | varchar(255)     |             | ○         |              |
| created_at   | timestamp        |             |           |              |
| updated_at   | timestamp        |             |           |              |


## weight_logsテーブル

| カラム名         | 型               | PRIMARY KEY | NOT NULL | FOREIGN KEY |
|------------------|------------------|-------------|-----------|--------------|
| id               | bigint unsigned  | ○           | ○         |              |
| user_id          | bigint unsigned  |             | ○         | users.id     |
| date             | date             |             | ○         |              |
| weight           | decimal(4,1)     |             | ○         |              |
| calories         | int              |             |           |              |
| exercise_time    | time             |             |           |              |
| exercise_content | text             |             |           |              |
| created_at       | timestamp        |             |           |              |
| updated_at       | timestamp        |             |           |              |

## weight_targetテーブル

| カラム名       | 型               | PRIMARY KEY | NOT NULL | FOREIGN KEY |
|----------------|------------------|-------------|-----------|--------------|
| id             | bigint unsigned  | ○           | ○         |              |
| user_id        | bigint unsigned  |             | ○         |  users.id    |
| target_weight  | decimal(4,1)     |             | ○         |              |
| current_weight | decimal(4,1)     |             |           |              |
| created_at     | timestamp        |             |           |              |
| updated_at     | timestamp        |             |           |              |

---

### 🗂 ER図（このプロジェクトのデータ構造）

このアプリケーションのデータ構造を視覚的に把握するため、以下にER図を掲載しています。

この図では、`users` テーブルを中心に、`weight_logs` テーブルと `weight_target` テーブルがリレーションで接続されています。  
`weight_logs` はユーザーの体重記録を保持し、`weight_target` は目標体重の履歴を保持するため、いずれも `users` に対して「1対多」の関係となっています。  
各テーブルは表形式で構成されており、主キー（PK）の役割が明示されています。

![ER図](assets/weight-logs-test3-er.png)

※ 補足：
1. 図は draw.io（diagrams.net）にて作成し、PNG形式で保存しています。  
2. 元データは `weight-logs-test3-er.drawio` にて編集可能です。  
3. PNGファイルは `assets/weight-logs-test3-er.png` に保存されています。  
   → READMEではこの画像を参照しています。  
4. 編集には [draw.io（diagrams.net）](https://app.diagrams.net/) を使用してください。  
　 ローカルアプリまたはブラウザ版のどちらでも編集可能です。  
5. ER図の更新手順：drawioで編集 → PNG再出力 → assetsに上書き保存 → README確認  
   ※GitHub上で画像が更新されない場合は、キャッシュをクリアしてください。
   
※このER図は、要件シートの「ER図欄」に対応した内容です。GitHub提出形式のため、READMEにて掲載しています。

---

### 🌐 ローカル環境での確認用URL
- アプリケーション: [http://localhost/login](http://localhost/login)
  → ログイン画面が表示されます
  
#### ログイン情報（ダミーアカウント）

```ini
email: dummy@example.com
password: password
```
  
- phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)
  → DB 接続確認やテーブル内容の確認が可能です

## 補足
ログイン画面が表示されないなど、`storage/logs` や `storage/framework/sessions` が存在しないことが原因で問題が起きる場合は、以下のコマンドでディレクトリを作成してください。

```bash
docker-compose exec php bash
cd /var/www/html
mkdir -p storage/logs
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
chown -R www-data:www-data storage
chmod -R 775 storage
```

---

### 🛡️ 会員登録時のメールアドレス制約について

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

### 🔐 認証後の遷移先について

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

### 🧮 current_weight カラム追加の設計意図
`weight_target` テーブルの `current_weight` カラムについて 仕様書（テーブル定義）には `current_weight` の記載はありませんが、画面仕様（PG09 初期体重登録画面）およびバリデーション定義（FN008〜FN009）において「現在の体重」の入力項目が存在するため、整合性を保つ目的で `weight_target` テーブルに `current_weight` カラムを追加しています。

このカラムは以下の目的で使用されます： 
- STEP2画面（初期目標体重登録画面）でユーザーが入力した「現在の体重」の保存先として使用
- 管理画面（PG01）上部の「最新体重」と「目標まで」（最新体重 - 目標体重）の表示に使用 
- 登録初期時に使用  
 - weight_logs が空なら weight_target.current_weight を使用  
 - weight_logs にデータがある場合は最新の日付の weight を使用
- 将来的に「初期体重 → 最新体重 → 目標体重」の進捗表示やグラフ描画に活用可能
- 画面仕様とDB設計の対応関係を明確にし、レビュー時の混乱を防止
  
 ※仕様書との差分については、画面仕様および管理画面UIに準拠した設計判断として記載しています。
 
 ※なお、管理画面（PG01）では `current_weight` は直接表示されませんが、初期登録時の「最新体重」として扱われるため、進捗計算の初期値として保存しています。

 ---

### 🚧 認証ミドルウェアによるアクセス制限について

管理画面（PG01）を含む体重ログ関連の画面は、ログイン済みのユーザーのみがアクセスできるように設計しています。

`WeightLogController` に `auth` ミドルウェアを追加することで、未ログイン状態でアクセスされた場合は自動的にログイン画面へリダイレクトされ、エラーを防止しています。

```php
public function __construct()
{
    $this->middleware('auth');
}
```

以上が本アプリケーションの仕様です。提出物は以上となりますので、ご確認のほどよろしくお願いいたします。


