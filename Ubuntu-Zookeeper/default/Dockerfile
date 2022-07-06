FROM ubuntu:18.04
RUN apt-get update

ENV HOME /root

#install git, vim, wget
RUN apt-get update && apt-get install -y git
RUN apt-get install -y vim
RUN apt-get install -y wget

#install nodejs
RUN apt-get install -y nodejs
RUN apt-get install -y npm
RUN apt-get install -y curl

ADD ./sh ${HOME}/sh

#install kafka
ENV ZOOKEEPER_VER 3.7.1
RUN apt-get install -y tar
RUN apt-get install -y openjdk-8-jdk
RUN cd ${HOME} && wget https://dlcdn.apache.org/zookeeper/zookeeper-${ZOOKEEPER_VER}/apache-zookeeper-${ZOOKEEPER_VER}-bin.tar.gz
RUN cd ${HOME} && tar -xzvf apache-zookeeper-${ZOOKEEPER_VER}-bin.tar.gz
RUN cd ${HOME} && rm apache-zookeeper-${ZOOKEEPER_VER}-bin.tar.gz
RUN cd ${HOME} && mv apache-zookeeper-${ZOOKEEPER_VER}-bin zookeeper


EXPOSE 22 9092

CMD ["/usr/sbin/sshd", "-D"]
