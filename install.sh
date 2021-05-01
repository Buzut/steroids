#!/bin/bash

if [[ $1 ==  "" || $2 == "" || $3 = "" || $4 == "" || $5 == "" || $6 == "" ]]
then
    echo "install.sh <dbname> <title> <url> <admin_user> <admin_passwd> <admin_email> [<locale (defaults to "en_US")>] [<mysql user (defaults to root)>] [<mysql password (defaults to empty)>"
    exit;
fi

if [[ $7 == "" ]]
then
    locale=en_US
else
    locale=$7
fi

if [[ $8 == "" ]]
then
    myuser=root
else
    myuser=$8
fi

if [[ $9 == "" ]]
then
    mysql -u "$myuser" -e "CREATE DATABASE $1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
else
    mysql -u "$myuser" -p"$9" -e "CREATE DATABASE $1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
fi

mkdir wordpress && cd wordpress \
&& curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
&& php wp-cli.phar core download --locale=$locale \
&& php wp-cli.phar config create --dbname=$1 --dbuser=root --dbpass="$9" --dbhost=127.0.0.1 --dbcharset=utf8mb4 --dbcollate=utf8mb4_unicode_ci \
&& php wp-cli.phar core install --title="$2" --url="$3" --admin_user="$4" --admin_password="$5" --admin_email=$6 \
&& php wp-cli.phar theme install https://github.com/Buzut/steroids/archive/master.zip --activate \
&& php wp-cli.phar theme uninstall `ls wp-content/themes/ | grep -v steroids | grep -v index.php | xargs` \
&& cd .. && chmod -R 775 wordpress
