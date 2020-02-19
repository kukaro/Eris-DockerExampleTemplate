FROM mysql:5.7
MAINTAINER kukaro <justkukaro@naver.com>

ADD ./mysql-init-files /docker-entrypoint-initdb.d

EXPOSE 3306

CMD ["mysqld"]