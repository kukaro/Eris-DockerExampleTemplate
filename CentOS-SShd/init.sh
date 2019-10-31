#!/usr/bin/env bash

#run myubuntu instance
docker build -t mycentos ./mycentos/
docker-compose -f ./mycentos/docker-compose.yml up -d

## docker run --rm -it ubuntu /bin/bash