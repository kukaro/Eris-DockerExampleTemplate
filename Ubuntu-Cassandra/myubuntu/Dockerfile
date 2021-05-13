FROM ubuntu:latest
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get update
#install git, vim, wget
RUN apt-get update && apt-get install -y git
RUN apt-get install -y vim
RUN apt-get install -y wget

#install nginx
RUN apt-get install -y nginx

#install nodejs
RUN apt-get install -y nodejs
RUN apt-get install -y npm
RUN apt-get install -y curl

#install kafka
ENV HOME /root
ENV CASSANDRA_VERSION 3.11.10
WORKDIR /$HOME
RUN apt-get install -y tar
RUN apt-get install -y openjdk-8-jdk
RUN curl -OL http://apache.mirror.digitalpacific.com.au/cassandra/${CASSANDRA_VERSION}/apache-cassandra-${CASSANDRA_VERSION}-bin.tar.gz
RUN gpg --print-md SHA256 apache-cassandra-${CASSANDRA_VERSION}-bin.tar.gz
RUN curl -L https://downloads.apache.org/cassandra/${CASSANDRA_VERSION}/apache-cassandra-${CASSANDRA_VERSION}-bin.tar.gz.sha256
RUN tar xzvf apache-cassandra-${CASSANDRA_VERSION}-bin.tar.gz
RUN rm -rf apache-cassandra-${CASSANDRA_VERSION}-bin.tar.gz
RUN mv apache-cassandra-${CASSANDRA_VERSION} cassandra

#change chown
RUN useradd -m -s /bin/bash newuser
RUN groupadd newusergroup
RUN chown newuser:newusergroup -R cassandra

#run
ADD ./run ${HOME}/run

EXPOSE 22 80 9042