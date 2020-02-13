FROM ubuntu:latest
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get update
RUN apt-get install -y openssh-server
RUN mkdir /var/run/sshd

# Set argument
ENV PROXY_VER 2.0.4
ENV HOME_DIR /root

# Set password
RUN echo 'root:root' |chpasswd

# replace sshd_config
RUN sed -ri 's/^#?PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config

# make .ssh
RUN mkdir /root/.ssh

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install vim
RUN apt-get update && apt-get install -y vim

#Install proxysql
RUN apt-get install -y wget mysql-client inotify-tools procps
RUN wget https://github.com/sysown/proxysql/releases/download/v${PROXY_VER}/proxysql_${PROXY_VER}-debian9_amd64.deb -O /opt/proxysql_${PROXY_VER}-debian9_amd64.deb
RUN dpkg -i /opt/proxysql_${PROXY_VER}-debian9_amd64.deb
RUN rm -f /opt/proxysql_${PROXY_VER}-debian9_amd64.deb && rm -rf /var/lib/apt/lists/*

#Install mysql
RUN apt-get update && apt-get install -y mysql-server

# Add file
ADD ./run ${HOME_DIR}/run

EXPOSE 22 6032

CMD ["/usr/sbin/sshd", "-D"]
