# Install ubuntu
FROM ubuntu:16.04
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get -y update && apt-get -y upgrade

#Set Argument
ENV DEST /var/www/
ENV AP_DIR /etc/apache2

# Install python
RUN apt-get -y update && apt-get -y install python3
RUN apt-get -y update && apt-get -y install python3-pip

# Install apache and mod_wsgi
RUN apt-get -y install apache2
RUN apt-get -y install libapache2-mod-wsgi-py3
RUN a2enmod wsgi
RUN a2enmod rewrite

# Make port 80 available to the world outside
EXPOSE 80

# install npm, bower
RUN apt-get -y install git
RUN apt-get -y install nodejs
RUN apt-get -y install npm
RUN apt-get install -y build-essential
RUN cp /usr/bin/nodejs /usr/bin/node
RUN npm install -g bower

# Import python project
ADD FLASKAPPS ${DEST}/FLASKAPPS

# Install module
RUN /usr/bin/pip3 install --upgrade pip && pip3 install -r ${DEST}/FLASKAPPS/requirements.txt
RUN cd ${DEST}/FLASKAPPS/ && bower install --allow-root

# Set apache configulation
ADD 000-default.conf ${AP_DIR}/sites-available/
ADD apache2.conf ${AP_DIR}
ADD .htaccess ${DEST}
ADD .htaccess ${DEST}/../
RUN mkdir -p ${DEST}/FLASKAPPS/logs
RUN cp ${DEST}/html/index.html ${DEST}/

# CMD
CMD /usr/sbin/apache2ctl -D FOREGROUND