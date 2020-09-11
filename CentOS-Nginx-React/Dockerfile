# Install ubuntu
FROM centos:7

ENV DEST /var/www/html

#centos7에서는 nginx를 설치하기위해서 레포지터리를 추가해야하는데 로컬에서 레포지터리 경로 작성해서 도커 컨테이너로 옮김
COPY ./file/nginx.repo /etc/yum.repos.d/
#nginx설치
RUN yum -y install nginx

#git 설치 혹시 모르니까
RUN yum -y install git
#nodejs설치를 위해서 epel설치 필요
RUN yum -y install epel-release
#nodejs설치
RUN yum -y install nodejs
#npm설치
RUN yum -y install npm
#혹시 웹링크 다운받을 수도 있으니까 wget 설치
RUN yum -y install wget
#설치한거 압축 해제해야하니까 zip이랑 unzip설치
RUN yum -y install unzip zip
#들어가서 에디팅 해야할 수 있으니까 vim설치
RUN yum -y install vim

#외부에 접속가능하게 포트 열어줌
EXPOSE 80

#컨테이너가 켜졌을때 작업시킬 작업, 근데 docker-compose로 열면 docker-compose의 entrypoint나 command가 덮어써서 별로 의미 없음
#docker는 해당 작업을 하고 "종료해버림" 종료 안하려면 포어그라운드에서 작업을 해야함
CMD nginx -g 'daemon off;'