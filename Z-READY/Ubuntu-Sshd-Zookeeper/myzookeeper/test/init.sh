#!/usr/bin/env bash

a=$(ifconfig | grep inet | tr -d ' ')
echo "$a"
a=$(expr match "$a" '\(inet[0-9]*.[0-9]*.[0-9]*.[0-9]*\)')
echo "${a:4}" > /root/myip/ip.txt

cp /root/myip/myid /var/lib/zookeeper/myid
/usr/share/zookeeper/bin/zkServer.sh start
/usr/sbin/sshd -D
