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
RUN echo "deb https://downloads.apache.org/cassandra/debian 40x main" | tee -a /etc/apt/sources.list.d/cassandra.sources.list
RUN curl https://downloads.apache.org/cassandra/KEYS | apt-key add -
RUN apt-get update
RUN apt-get install cassandra

#change chown
RUN useradd -m -s /bin/bash newuser
RUN groupadd newusergroup
RUN chown newuser:newusergroup -R /etc/cassandra

#run
ADD ./run ${HOME}/run

EXPOSE 22 80 9042
