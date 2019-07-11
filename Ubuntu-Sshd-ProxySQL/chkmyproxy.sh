#!/usr/bin/env bash

myaddress=`ipconfig getifaddr en0`
myaddress=${myaddress}

echo '**********'
mysql -umyadmin --port 16032 -h 127.0.0.1 -p -e "select * from main.global_variables where variable_name like 'mysql-shun%';"
echo '**********'
