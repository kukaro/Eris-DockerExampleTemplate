#!/bin/bash
hostname=`hostname -I | tr -d ' '`

cd ~/kafka
./bin/kafka-console-producer.sh --broker-list "${hostname}":9092 --topic test
