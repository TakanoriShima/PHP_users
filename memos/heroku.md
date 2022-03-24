# PHP/MySQLアプリのHerokuへのデプロイ（Amazon Linux AMI 編）
<p style='text-align: right;'> &copy; 20220324 by Takanori Shima </p>

[Heroku（ヘロク）とは](https://www.sejuku.net/blog/7858)

## Herokuのサイトに登録する

[Herokuの公式サイト](https://id.heroku.com/login)

* [Heroku上でMySQLを使うために、クレジットカード情報も登録](http://kakedashi-xx.com:25214/index.php/2021/12/19/post-3879/)

## Cloud9のワークスペースにHeroku のインストール
* アプリのフォルダを右クリックし、ターミナルを開いて以下のコマンドを順に実行する

```
wget https://cli-assets.heroku.com/heroku-linux-x64.tar.gz -O heroku.tar.gz
sudo mkdir -p /usr/local/lib/heroku
sudo tar --strip-components 1 -zxvf heroku.tar.gz -C /usr/local/lib/heroku
sudo ln -s /usr/local/lib/heroku/bin/heroku /usr/local/bin/heroku
```

## Herokuへログイン

```
heroku login -i
```
Herokuの登録したメールアドレスとパスワードを入力してエンターキーを押す


## Herokuで新規アプリを作成
仮に作成する新規アプリ名を **quark2galaxy-users** とする。
```
heroku create quark2galaxy-users
heroku apps
git remote -v
```


## Heroku上で MySQLのアドオンを追加
```
heroku addons:create cleardb:ignite --app quark2galaxy-users --version=8.0
```

## Herokuに自動生成された MySQLの情報を確認する

* 以下は一例

```
heroku config --app quark2galaxy-users | grep CLEARDB_DATABASE_URL
CLEARDB_DATABASE_URL: mysql://bc8809960cc3e6:0e5ed0be@us-cdbr-east-05.cleardb.net/heroku_f7a9157680a6deb?reconnect=true
```
上記で表示された結果は一般的に以下のような書式となる
```
mysql://(ユーザ名):(パスワード)@(ドメイン)/(データベース名)?reconnect=true
```

これを見比べると、今回は以下のように対応づけられる
```
ユーザ名: bc8809960cc3e6
パスワード: 0e5ed0be
ドメイン: us-cdbr-east-05.cleardb.net
データベース名: heroku_f7a9157680a6deb
```
## Cloud9上のMySQL情報のバックアップファイルを作成

```
sudo service mysqld start
mysqldump -u root user_register > dump.sql
```

## Heroku上のMySQLにCloud9からログインする
* 以下が一般書式となる
```
mysql -h (ドメイン) -u (ユーザ名) -p
```

上記の自動生成されたHeroku上のMySQL情報と見比べると、今回は以下のコマンドを実行する。
パスワードを求められるが、上記の自動設定されたパスワードをコピペして実行する。

```
mysql -h us-cdbr-east-05.cleardb.net -u bc8809960cc3e6 -p
```

## Heroku上のMySQLでテーブル作成する

```
mysql> show databases;
mysql> use heroku_f7a9157680a6deb;
mysql> source dump.sql;
mysql> show tables;
mysql> select * from users;
```
## Cloud9のプログラムをHeroku上のMySQLに接続するように変更する

Model.php
```php
        // データベースと接続を行うメソッド
        protected static function get_connection(){
            try {
                // オプション設定
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,   //デフォルトのフェッチモードはクラス
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
                );
                // データベースを扱う万能の神様誕生
                // $pdo = new PDO('mysql:host=localhost;dbname=user_register', 'root', '', $options);
                $pdo = new PDO('mysql:host=us-cdbr-east-05.cleardb.net;dbname=heroku_f7a9157680a6deb', 'bc8809960cc3e6', '0e5ed0be', $options);
                return $pdo;
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
```

## Git/Github
```
git add .
git commit -m "Heroku設定完了"
```

## Herokuにデプロイする
```
git push heroku main
```

## アプリを起動する
Herokuの公式サイトにログインし、アプリを選択し、右上の **Open app** ボタンを押す
