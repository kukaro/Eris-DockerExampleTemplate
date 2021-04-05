#!/usr/bin/env bash

cd /root/project && ./gradlew build
chmod -R 777 /root/project/build/libs
java -jar /root/project/build/libs/myspring-0.0.1-SNAPSHOT.jar