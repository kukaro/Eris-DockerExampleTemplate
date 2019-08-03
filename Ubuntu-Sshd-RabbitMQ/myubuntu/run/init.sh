#!/usr/bin/env bash

#rabbitmq server -detached
service rabbitmq-server start
rabbitmqctl add_user uguest pguest
rabbitmqctl set_user_tags uguest administrator
rabbitmqctl set_permissions -p / uguest ".*" ".*" ".*"

/usr/sbin/sshd -D
