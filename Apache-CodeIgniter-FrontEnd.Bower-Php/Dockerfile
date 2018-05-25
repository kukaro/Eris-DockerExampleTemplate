# Install ubuntu
FROM ubuntu:16.04
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get -y update && apt-get -y upgrade

# Set Argument
ENV DEST /var/www/html
ENV CI_VER 3.1.8

# Install php
RUN apt-get -y install php

# Install apache
RUN apt-get -y install apache2
RUN apt install libapache2-mod-php7.0 libapache2-mod-php
RUN a2enmod php7.0
RUN a2enmod rewrite

# Install CodeIgnither
RUN apt-get -y install wget
RUN apt-get -y install unzip
RUN cd ${DEST} && wget https://github.com/bcit-ci/CodeIgniter/archive/${CI_VER}.zip
RUN cd ${DEST} && unzip ${CI_VER}.zip
RUN cd ${DEST} && rm ${CI_VER}.zip
RUN cd ${DEST} && mv C* CI
RUN cd ${DEST} && ls