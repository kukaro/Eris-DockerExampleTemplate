#!/usr/bin/env bash

PORT_NUMBER=$1
MY_ADDRESS=$2

# run server
cd /root/server && pm2 start bin/www server -- ${PORT_NUMBER}

# Start sshd
/usr/sbin/sshd -D
