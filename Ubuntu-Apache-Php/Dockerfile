# Install Ubuntu
FROM ubuntu:18.04
MAINTAINER kukaro <justkukaro@naver.com>

# Set Argument
ENV DEST /var/www/html

# Need Another
RUN apt-get -y update && apt-get -y install vim

# php7.2인스톨 할때 타임존 입력하게 하는거 이걸로 하면 해결됨
ENV TZ=Asia/Seoul
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install
RUN apt-get -y install apache2
RUN apt-get -y install php7.2
RUN apt-get -y update && apt-get install libapache2-mod-php
RUN a2enmod php7.2