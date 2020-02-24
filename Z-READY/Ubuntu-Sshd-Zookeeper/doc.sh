#!/usr/bin/env bash

vim /etc/zookeeper/conf/zoo.cfg

#주키퍼 서버시작, 재시작은 restart, 정지는 stop
zkServer.sh start