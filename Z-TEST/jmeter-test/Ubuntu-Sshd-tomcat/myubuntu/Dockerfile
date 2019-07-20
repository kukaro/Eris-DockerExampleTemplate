FROM ubuntu:latest
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get update
RUN apt-get install -y openssh-server
RUN mkdir /var/run/sshd

#Set argument
ENV HOME_DIR /root

#set password
RUN echo 'root:root' |chpasswd

#replace sshd_config
RUN sed -ri 's/^#?PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config

#make .ssh
RUN mkdir /root/.ssh

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#Install nginx
RUN apt-get update && apt-get install -y vim
RUN apt-get update && apt-get install -y wget
RUN apt-get update && apt-get install -y tar
RUN apt-get update && apt-get install -y openjdk-8-jre
RUN apt-get update && apt-get install -y openjdk-8-jdk
RUN cd ${HOME_DIR} && wget http://apache.mirror.cdnetworks.com/tomcat/tomcat-8/v8.5.43/bin/apache-tomcat-8.5.43.tar.gz
RUN cd ${HOME_DIR} && tar -xzf apache-tomcat-8.5.43.tar.gz
RUN cd ${HOME_DIR} && rm apache-tomcat-8.5.43.tar.gz && mv apache-tomcat-8.5.43 tomcat

#Add file
ADD ./run ${HOME_DIR}/run
ADD ./test ${HOME_DIR}/tomcat/webapps

EXPOSE 22 8080

CMD ["/usr/sbin/sshd", "-D"]
