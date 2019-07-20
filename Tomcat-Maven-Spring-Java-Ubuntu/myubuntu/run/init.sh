#!/usr/bin/env bash
#init.sh

# Run tomcat
cd /root/tomcat/bin && ./startup.sh

# Start sshd
/usr/sbin/sshd -D
