#!/usr/bin/env bash

# Run nginx
cd /root/tomcat/bin && ./startup.sh

# Start sshd
/usr/sbin/sshd -D
