#!/usr/bin/env bash
# This example is referenced by https://coding-start.tistory.com/133?category=790331

# if you want to see ports, you enter code below to view.
#lsof -i -nP | grep LISTEN | awk '{print $(NF-1)" "$1}' | sort -u
#lsof -i -nP | grep LISTEN | sort -u



# setting
cd /root
echo 'run init.sh' >> log.txt
./run/vim.sh

cd kafka #카프카가 설치되어있는 디렉터리로 이동한다.
hostname=`hostname -I | tr -d ' '`
sed -ri "s/#advertised.listeners=PLAINTEXT:\/\/your.host.name:9092/listeners=PLAINTEXT:\/\/${hostname}:9092/" config/server.properties

# zookeeper on
./bin/zookeeper-server-start.sh -daemon config/zookeeper.properties
# kafka on
./bin/kafka-server-start.sh -daemon config/server.properties

sleep 5s
# make topic
./bin/kafka-topics.sh --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic test

# delete topic
#./bin/kafka-topics.sh --delete --zookeeper localhost:2181 --topic test

# see result , if you want to excute, you remove sharp(#) plz.
#./bin/kafka-topics.sh --describe --zookeeper localhost:2181 --topic test

# 프로듀서 시작할때 이거 키고 다.
#./bin/kafka-console-producer.sh --broker-list localhost:9092 --topic test

# 컨슈머로 읽을때 이거 키고 받는다.
#./bin/kafka-console-consumer.sh --bootstrap-server localhost:9092 --topic test --from-beginning

cd /root/run
./build.sh

cd /root
chmod -R 777 ./script
/usr/sbin/sshd -D

