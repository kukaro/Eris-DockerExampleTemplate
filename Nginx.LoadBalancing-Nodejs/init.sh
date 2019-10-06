#!/usr/bin/env bash

MY_ADDRESS1=`ipconfig getifaddr en0`
MY_ADDRESS1=${MY_ADDRESS1}
PORT_NUMBER1=4000

MY_ADDRESS2=${MY_ADDRESS1}
PORT_NUMBER2=5000

#run myubuntu instance
docker build -t mynginx --build-arg PORT_NUMBER1=${PORT_NUMBER1} --build-arg MY_ADDRESS1=${MY_ADDRESS1} --build-arg PORT_NUMBER2=${PORT_NUMBER2} --build-arg MY_ADDRESS2=${MY_ADDRESS2} ./mynginx/
docker build -t myserver ./myserver/
PORT_NUMBER1=${PORT_NUMBER1} MY_ADDRESS1=${MY_ADDRESS1} PORT_NUMBER2=${PORT_NUMBER2} MY_ADDRESS2=${MY_ADDRESS2} docker-compose up -d

#https://github.com/heowc/programming-study/issues/90