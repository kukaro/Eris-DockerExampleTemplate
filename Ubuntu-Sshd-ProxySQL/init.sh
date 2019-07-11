#!/usr/bin/env bash

#run myubuntu instance
docker build -t myproxysql ./myproxysql/
docker-compose -f myproxysql/docker-compose.yml up -d
