#!/usr/bin/env bash

myaddress=`ipconfig getifaddr en0`
myaddress=${myaddress}

ssh -p 11111 root@${myaddress}
