#!/usr/bin/env bash

docker stop mynginx
docker rm mynginx
#docker rmi myubuntu

docker stop myserver1
docker rm myserver1

docker stop myserver2
docker rm myserver2
