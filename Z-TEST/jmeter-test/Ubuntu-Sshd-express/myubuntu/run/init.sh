#!/usr/bin/env bash

# Run
cd /root/was && pm2 start bin/www --name "test"

# Start sshd
/usr/sbin/sshd -D
