#!/usr/bin/env bash

myaddress=`ipconfig getifaddr en0`
myaddress=${myaddress}

ssh -p 30022 root@${myaddress}
