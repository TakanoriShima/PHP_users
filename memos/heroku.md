$ wget https://cli-assets.heroku.com/heroku-linux-x64.tar.gz -O heroku.tar.gz
$ sudo mkdir -p /usr/local/lib/heroku
$ sudo tar --strip-components 1 -zxvf heroku.tar.gz -C /usr/local/lib/heroku
$ sudo ln -s /usr/local/lib/heroku/bin/heroku /usr/local/bin/heroku
heroku login -i
heroku create quark2galaxy-users
heroku apps
git remote -v
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
git add .
git commit -m 'Procfileを追加'
git log

heroku addons:create cleardb:ignite --app quark2galaxy-users --version=8.0
heroku config --app quark2galaxy-users | grep CLEARDB_DATABASE_URL
CLEARDB_DATABASE_URL: mysql://bc8809960cc3e6:0e5ed0be@us-cdbr-east-05.cleardb.net/heroku_f7a9157680a6deb?reconnect=true

#
mysql://(ユーザ名):(パスワード)@(ドメイン)/(データベース名)?reconnect=true
ユーザ名: bc8809960cc3e6
パスワード: 0e5ed0be
ドメイン: us-cdbr-east-05.cleardb.net
データベース名: heroku_f7a9157680a6deb

# mysql -h (ドメイン) -u (ユーザ名) -p
mysql -h us-cdbr-east-05.cleardb.net -u bc8809960cc3e6 -p
show databases;
use heroku_f7a9157680a6deb;
source dump.sql;
show tables;
select * from users;



sudo service mysqld start
mysqldump -u root user_register > dump.sql

