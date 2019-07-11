#!/usr/bin/env bash

myaddress=`ipconfig getifaddr en0`
myaddress=${myaddress}

ssh -p 10022 root@${myaddress}
