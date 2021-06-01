#!/bin/bash

if [[ $1 ==  "" || $2 == "" || $3 = "" || $4 == "" || $5 == "" || $6 == "" ]]
then
    echo "install.sh <dbname> <title> <url> <admin_user> <admin_passwd> <admin_email> [<mysql user (defaults to root)>] [<mysql password (defaults to empty)>"
    exit;
fi

if [[ $7 == "" ]]
then
    myuser=root
else
    myuser=$7
fi

if [[ $8 == "" ]]
then
    mysql -u "$myuser" -e "CREATE DATABASE $1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
else
    mysql -u "$myuser" -p"$8" -e "CREATE DATABASE $1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
fi

php public/wp-cli.phar config create --dbname=$1 --dbuser=$myuser --dbpass="$8" --dbhost=127.0.0.1 --dbcharset=utf8mb4 --dbcollate=utf8mb4_unicode_ci \
&& php public/wp-cli.phar core install --title="$2" --url="$3" --admin_user="$4" --admin_password="$5" --admin_email=$6 \
