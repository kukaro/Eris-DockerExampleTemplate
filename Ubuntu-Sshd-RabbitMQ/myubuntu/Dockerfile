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

#install rabbitmq
#RUN apt-get install rabbitmq-server

#install git, vim
RUN apt-get update && apt-get install -y git
RUN apt-get update && apt-get install -y vim

#install nodejs
RUN apt-get update && apt-get install -y nodejs
RUN apt-get update && apt-get install -y npm
RUN apt-get update && apt-get install -y curl

#setting vim
RUN git clone https://github.com/VundleVim/Vundle.vim.git
RUN mkdir -p /root/.vim/bundle
RUN mv Vundle.vim /root/.vim/bundle
ADD ./.vimrc /root/
RUN vim -c 'PluginInstall' -c 'qa!'
RUN cd /root/.vim/bundle/vim-prettier && npm install

#install js beautify
RUN npm -g install js-beautify

#install rabbimq
RUN apt-get update && apt-get install -y rabbitmq-server
RUN rabbitmq-plugins enable rabbitmq_management
ADD ./run /root/run

EXPOSE 22 5672 15672

CMD ["rabbitmq-server"]
