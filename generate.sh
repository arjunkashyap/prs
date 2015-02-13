#!/bin/sh

host="localhost"
db="prs"
usr="root"
pwd="mysql"

echo "drop database prs; create database prs charset utf8 collate utf8_general_ci;" | /usr/bin/mysql -uroot -pmysql

perl insert_author.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd
