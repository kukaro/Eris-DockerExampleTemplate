#!/bin/bash

source /root/.bash_profile
cd / && /etc/bootstrap.sh

service mysqld start
#/usr/sbin/sshd -D
httpd -DFOREGROUND
#/bin/bash