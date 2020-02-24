FROM ubuntu:latest
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get update
RUN apt-get install -y openssh-server
RUN mkdir /var/run/sshd

#set password
RUN echo 'root:root' |chpasswd

#replace sshd_config
RUN sed -ri 's/^#?PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config

#make .ssh
RUN mkdir /root/.ssh

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#install git, vim
RUN apt-get update && apt-get install -y git
RUN apt-get install -y vim
RUN apt-get install -y curl
RUN apt-get install -y iputils-ping
RUN apt-get install -y net-tools
RUN apt-get install -y default-jdk

#setting vim
RUN git clone https://github.com/VundleVim/Vundle.vim.git
RUN mkdir -p /root/.vim/bundle
RUN mv Vundle.vim /root/.vim/bundle
ADD ./.vimrc /root/
RUN vim -c 'PluginInstall' -c 'qa!'

#install zookeeper
RUN apt-get install -y zookeeper
RUN echo 'export PATH=$PATH:/usr/share/zookeeper/bin' >> /root/.bashrc
RUN sed -ri 's/#server.1=zookeeper1:2888:3888/server.1=zookeeper1:2888:3888/g' /etc/zookeeper/conf/zoo.cfg
RUN sed -ri 's/#server.2=zookeeper2:2888:3888/server.2=zookeeper2:2888:3888/g' /etc/zookeeper/conf/zoo.cfg
RUN sed -ri 's/#server.3=zookeeper3:2888:3888/server.3=zookeeper3:2888:3888/g' /etc/zookeeper/conf/zoo.cfg

#set test file
ADD ./test /root/test/
RUN chmod -R 777 /root/test
RUN chmod 777 /var/lib/zookeeper/myid

EXPOSE 22 80 8080

CMD ["/usr/sbin/sshd", "-D"]
