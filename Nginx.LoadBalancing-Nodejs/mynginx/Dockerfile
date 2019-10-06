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

#install nodejs
RUN apt-get install -y nodejs
RUN apt-get install -y npm
RUN apt-get install -y curl

#setting vim
RUN git clone https://github.com/VundleVim/Vundle.vim.git
RUN mkdir -p /root/.vim/bundle
RUN mv Vundle.vim /root/.vim/bundle
ADD ./.vimrc /root/
RUN vim -c 'PluginInstall' -c 'qa!'
RUN cd /root/.vim/bundle/vim-prettier && npm install

#install nginx
RUN apt-get install -y nginx
ADD ./config/default /etc/nginx/sites-available
ADD ./run/ /root

#install js beautify
RUN npm -g install js-beautify

ARG PORT_NUMBER1
ARG MY_ADDRESS1
ARG PORT_NUMBER2
ARG MY_ADDRESS2
RUN sed -ri 's/MY_ADDRESS1/'${MY_ADDRESS1}'/' /etc/nginx/sites-available/default
RUN sed -ri 's/PORT_NUMBER1/'${PORT_NUMBER1}'/' /etc/nginx/sites-available/default
RUN sed -ri 's/MY_ADDRESS2/'${MY_ADDRESS2}'/' /etc/nginx/sites-available/default
RUN sed -ri 's/PORT_NUMBER2/'${PORT_NUMBER2}'/' /etc/nginx/sites-available/default

EXPOSE 22 80 8080

CMD ["/usr/sbin/sshd", "-D"]
