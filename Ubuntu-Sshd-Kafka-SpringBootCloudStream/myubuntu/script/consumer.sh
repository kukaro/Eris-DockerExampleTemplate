#!/bin/bash
hostname=`hostname -I | tr -d ' '`

cd ~/kafka
./bin/kafka-console-consumer.sh --bootstrap-server "${hostname}":9092 --topic test --from-beginning