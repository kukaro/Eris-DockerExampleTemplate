#!/usr/bin/env bash
# This example is referenced by https://coding-start.tistory.com/133?category=790331

# if you want to see ports, you enter code below to view.
#lsof -i -nP | grep LISTEN | awk '{print $(NF-1)" "$1}' | sort -u
#lsof -i -nP | grep LISTEN | sort -u

# test
cd /root
echo 'my test' > test.txt

cd kafka

# make cluster
cp config/server.properties config/server-1.properties
cp config/server.properties config/server-2.properties
sed -ri 's/broker.id=0/broker.id=1/' config/server-1.properties
sed -ri 's/#listeners=PLAINTEXT:\/\/:9092/listeners=PLAINTEXT:\/\/:9093/' config/server-1.properties
sed -ri 's/log.dirs=\/tmp\/kafka-logs/log.dirs=\/tmp\/kafka-logs-1/' config/server-1.properties

sed -ri 's/broker.id=0/broker.id=2/' config/server-2.properties
sed -ri 's/#listeners=PLAINTEXT:\/\/:9092/listeners=PLAINTEXT:\/\/:9094/' config/server-2.properties
sed -ri 's/log.dirs=\/tmp\/kafka-logs/log.dirs=\/tmp\/kafka-logs-2/' config/server-2.properties

sed -ri 's/zookeeper.connect=localhost:2181/zookeeper.connect=localhost:2181,localhost:2182,localhost:2183\/kafka-broker/' config/server.properties
sed -ri 's/zookeeper.connect=localhost:2181/zookeeper.connect=localhost:2181,localhost:2182,localhost:2183\/kafka-broker/' config/server-1.properties
sed -ri 's/zookeeper.connect=localhost:2181/zookeeper.connect=localhost:2181,localhost:2182,localhost:2183\/kafka-broker/' config/server-2.properties



# zookeeper on
./bin/zookeeper-server-start.sh -daemon config/zookeeper.properties
# kafka on
./bin/kafka-server-start.sh -daemon config/server.properties
./bin/kafka-server-start.sh -daemon config/server-1.properties
./bin/kafka-server-start.sh -daemon config/server-2.properties
sleep 5s
# make topic
#./bin/kafka-topics.sh --create --zookeeper localhost:2181,localhost:2182,localhost:2183/kafka-broker --replication-factor 3 --partitions 1 --topic test-topic

# delete topic
#./bin/kafka-topics.sh --delete --zookeeper localhost:2181,localhost:2182,localhost:2183/kafka-broker --topic test-topic

# see result , if you want to excute, you remove sharp(#) plz.
#./bin/kafka-topics.sh --describe --zookeeper localhost:2181,localhost:2182,localhost:2183/kafka-broker --topic test-topic

# 프로듀서 시작할때 이거 키고 다.
#./bin/kafka-console-producer.sh --broker-list localhost:9092,localhost:9093,localhost:9094 --topic test-topic

# 컨슈머로 읽을때 이거 키고 받는다.
#./bin/kafka-console-consumer.sh --bootstrap-server localhost:9092,localhost:9093,localhost:9094 --topic test-topic --from-beginning

/usr/sbin/sshd -D