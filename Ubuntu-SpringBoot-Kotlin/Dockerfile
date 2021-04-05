FROM ubuntu:latest
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get update
ENV HOME ROOT
ENV HTML_PATH /usr/share/nginx/html
ENV JAVA_VER 11

#set timezone
ENV TZ=Asia/Seoul
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#install git, vim
RUN apt-get update && apt-get install -y git
RUN apt-get install -y vim

#install nodejs
RUN apt-get install -y nodejs
RUN apt-get install -y npm
RUN apt-get install -y curl

#setting vim
RUN git clone https://github.com/VundleVim/Vundle.vim.git
RUN mkdir -p $HOME/.vim/bundle
RUN mv Vundle.vim $HOME/.vim/bundle
ADD ./.vimrc $HOME/
RUN vim -c 'PluginInstall' -c 'qa!'
RUN cd $HOME/.vim/bundle/vim-prettier && npm install

#install nginx
RUN apt-get install -y nginx
ADD ./script/ /root/script

#install java
RUN apt-get install -y openjdk-${JAVA_VER}-jdk


EXPOSE 22 80 8080
