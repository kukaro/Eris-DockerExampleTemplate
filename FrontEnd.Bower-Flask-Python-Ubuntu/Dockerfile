# Install ubuntu
FROM ubuntu:16.04
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get -y update && apt-get -y upgrade

# Set Argument
ENV DEST /var/www/html

# Install python
RUN apt-get -y install python3
RUN apt-get -y update && apt-get -y install python3-pip

# Make port 80 available to the world outside
EXPOSE 5000

# install npm, bower
RUN apt-get -y install git
RUN apt-get -y install nodejs
RUN apt-get -y install npm
RUN apt-get install -y build-essential
RUN cp /usr/bin/nodejs /usr/bin/node
RUN npm install -g bower

# Import python project
ADD FLASKAPP ${DEST}/FLASKAPP

# Install module
RUN /usr/bin/pip3 install --upgrade pip && pip3 install -r ${DEST}/FLASKAPP/requirements.txt
RUN cd ${DEST}/FLASKAPP/ && bower install --allow-root

# CMD
CMD python3 ${DEST}/FLASKAPP/__init__.py -D FOREGROUND
