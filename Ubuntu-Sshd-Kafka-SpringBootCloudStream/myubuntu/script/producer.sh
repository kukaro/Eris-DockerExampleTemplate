#!/bin/bash

cd ~/kafka
hostname=`hostname -I | tr -d ' '`
./bin/kafka-console-producer.sh --broker-list "${hostname}":9092 --topic test
#./bin/kafka-console-producer.sh --broker-list localhost:9092 --topic test
