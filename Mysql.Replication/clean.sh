#!/usr/bin/env bash

docker stop mymaster
docker rm mymaster
docker rmi mymaster
docker stop myslave
docker rm myslave
docker rmi myslave

