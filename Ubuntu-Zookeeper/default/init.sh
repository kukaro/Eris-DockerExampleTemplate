#!/usr/bin/env bash

# run zookeeper_test instance
docker build -t zookeeper_test .
docker-compose up -d
