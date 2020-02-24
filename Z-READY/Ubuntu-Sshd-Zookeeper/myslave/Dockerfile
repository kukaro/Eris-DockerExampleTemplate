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

#set test file
ADD ./test /root/test/
RUN chmod -R 777 /root/test

#install git, vim
RUN apt-get update && apt-get install -y git
RUN apt-get install -y vim
RUN apt-get install -y curl
#netstat -tnlp
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

EXPOSE 22 80 8080

CMD ["/usr/sbin/sshd", "-D"]
