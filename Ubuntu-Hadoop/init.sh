#!/usr/bin/env bash

#run myubuntu instance
docker build -t namenode ./NameNode/
docker-compose up -d
