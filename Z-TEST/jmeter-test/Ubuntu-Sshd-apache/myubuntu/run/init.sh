#!/usr/bin/env bash

# Run nginx
service apache2 start

# Start sshd
/usr/sbin/sshd -D
