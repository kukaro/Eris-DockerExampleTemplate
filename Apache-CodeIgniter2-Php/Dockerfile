# Install ubuntu
FROM ubuntu:16.04
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get -y update && apt-get -y upgrade

# Set Argument
ENV DEST /var/www/html
ENV CI_VER 2.2.6

# Install php
RUN apt-get -y install php

# Install apache
RUN apt-get -y install apache2
RUN apt install libapache2-mod-php7.0 libapache2-mod-php
RUN a2enmod php7.0
RUN a2enmod rewrite

# install npm, bower
RUN apt-get -y install git
RUN apt-get -y install nodejs
RUN apt-get -y install npm
RUN apt-get install -y build-essential
RUN cp /usr/bin/nodejs /usr/bin/node
RUN npm install -g bower

# Install CodeIgnither
RUN apt-get -y install wget
RUN apt-get -y install unzip
RUN cd ${DEST} && wget https://github.com/bcit-ci/CodeIgniter/archive/${CI_VER}.zip
RUN cd ${DEST} && unzip ${CI_VER}.zip
RUN cd ${DEST} && rm ${CI_VER}.zip
RUN mv ${DEST}/C*/* ${DEST}
RUN rm -rf ${DEST}/C*
RUN rm ${DEST}/index.html

#Set apache configulation
ADD 000-default.conf /etc/apache2/sites-available/
ADD apache2.conf /etc/apache2/

# CMD
CMD /usr/sbin/apache2ctl -D FOREGROUND