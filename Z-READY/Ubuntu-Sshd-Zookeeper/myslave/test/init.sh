#!/usr/bin/env bash

ifconfig > /root/myip/ip.txt
/usr/sbin/sshd -D