#!/usr/bin/env bash
# if you want to see ports, you enter code below to view.
#lsof -i -nP | grep LISTEN | awk '{print $(NF-1)" "$1}' | sort -u

# test
cd /root
echo 'my test' > test.txt

cd kafka
# zookeeper on
./bin/zookeeper-server-start.sh -daemon config/zookeeper.properties
# kafka on
./bin/kafka-server-start.sh -daemon config/server.properties
sleep 5s
# make topic
./bin/kafka-topics.sh --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 1 --topic test

# make cluster
cp config/server.properties config/server-1.properties
cp config/server.properties config/server-2.properties
sed -ri 's/broker.id=0/broker.id=1/' config/server-1.properties
sed -ri 's/#listeners=PLAINTEXT:\/\/:9092/listeners=PLAINTEXT:\/\/:9093/' config/server-1.properties
sed -ri 's/log.dirs=\/tmp\/kafka-logs/log.dirs=\/tmp\/kafka-logs-1/' config/server-1.properties

sed -ri 's/broker.id=0/broker.id=2/' config/server-2.properties
sed -ri 's/#listeners=PLAINTEXT:\/\/:9092/listeners=PLAINTEXT:\/\/:9094/' config/server-2.properties
sed -ri 's/log.dirs=\/tmp\/kafka-logs/log.dirs=\/tmp\/kafka-logs-2/' config/server-2.properties

# run cluster server
./bin/kafka-server-start.sh -daemon config/server-1.properties
./bin/kafka-server-start.sh -daemon config/server-2.properties
sleep 5s

# replication 3개, 파티션 1개
./bin/kafka-topics.sh --create --bootstrap-server localhost:9092 --replication-factor 3 --partitions 1 --topic my-replicated-topic

# see result , if you want to excute, you remove sharp(#) plz.
#./bin/kafka-topics.sh --describe --bootstrap-server localhost:9092 --topic my-replicated-topic

/usr/sbin/sshd -D