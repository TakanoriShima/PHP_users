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