#!/usr/bin/env bash

# Open proxysql and mysqld
proxysql --initial
mysqld

sleep 10s

# Set init mysql value
mysql -uadmin --port 6032 -h 127.0.0.1 -padmin -e "insert into main.mysql_users(username, password, default_hostgroup) values('kukaro','kukaro','1');"
mysql -uadmin --port 6032 -h 127.0.0.1 -padmin -e "update main.global_variables set variable_value='myadmin:myadmin' where variable_name = 'admin-admin_credentials';"
mysql -uadmin --port 6032 -h 127.0.0.1 -padmin -e "LOAD MYSQL VARIABLES TO RUNTIME;"
mysql -uadmin --port 6032 -h 127.0.0.1 -padmin -e "SAVE MYSQL VARIABLES TO DISK;"
mysql -uadmin --port 6032 -h 127.0.0.1 -padmin -e "LOAD ADMIN VARIABLES TO RUNTIME;"
mysql -uadmin --port 6032 -h 127.0.0.1 -padmin -e "SAVE ADMIN VARIABLES TO DISK;"


# Start sshd
/usr/sbin/sshd -D
