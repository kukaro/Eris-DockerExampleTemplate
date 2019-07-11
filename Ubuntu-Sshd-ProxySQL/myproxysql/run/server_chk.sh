#!/usr/bin/env bash

mysql -uadmin --port 6032 -h 127.0.0.1 -p -e "select * from main.global_variables where variable_name like 'mysql-shun%';"
