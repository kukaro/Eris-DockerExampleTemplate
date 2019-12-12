#!/usr/bin/env bash

# test
cd /root
echo 'my test' > test.txt

cd kafka
./bin/zookeeper-server-start.sh -daemon config/zookeeper.properties
./bin/kafka-server-start.sh -daemon config/server.properties
sleep 5s
./bin/kafka-topics.sh --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 1 --topic test

/usr/sbin/sshd -D