#!/usr/bin/env bash

sed -ri 's/\/var\/www\/html/\/var\/www\/html\/project\/public/g' /etc/apache2/sites-available/000-default.conf

/usr/sbin/apache2ctl -D FOREGROUND
/usr/sbin/sshd -D FOREGROUND