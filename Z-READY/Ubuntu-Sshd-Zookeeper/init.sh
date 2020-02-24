#!/usr/bin/env bash

#run myubuntu instance
docker build -t myzookeeper ./myzookeeper/
docker build -t myslave ./myslave/
docker-compose up -d
