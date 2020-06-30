FROM mysql:5.7
MAINTAINER kukaro <justkukaro@naver.com>

ENV TZ=Asia/Seoul
RUN apt-get update && apt-get -y install net-tools
RUN apt-get update && apt-get -y install vim
RUN apt-get update && apt-get -y install git
RUN apt-get -y install iputils-ping
RUN rm /etc/mysql/conf.d/mysql.cnf
RUN echo "[client]\ndefault-character-set = utf8\n\n[mysqld]\ngeneral_log=ON\ngeneral_log_file=/var/lib/mysql/global.log\ncharacter-set-client-handshake=FALSE init_connect=\"SET collation_connection = utf8_general_ci\"\ninit_connect=\"SET NAMES utf8\"\ncharacter-set-server = utf8\ncollation-server = utf8_general_ci\n\n[mysqldump]\ndefault-character-set = utf8\n\n[mysql]\ndefault-character-set = utf8\n" > /etc/mysql/conf.d/mysql.cnf

ADD ./sql /docker-entrypoint-initdb.d
ADD ./script /root/script
RUN touch ~/.vimrc
RUN echo "set nu\n" >> ~/.vimrc

EXPOSE 3306

CMD ["mysqld"]