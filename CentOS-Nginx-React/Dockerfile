# Install centos
FROM centos:7

ENV DEST /var/www/html

#centos7에서는 nginx를 설치하기위해서 레포지터리를 추가해야하는데 로컬에서 레포지터리 경로 작성해서 도커 컨테이너로 옮김
COPY ./file/nginx.repo /etc/yum.repos.d/
#nginx를 베이스로켜되 tomcat 껏다컷다 가능하게 하기위해서 entrypoint.sh를 만듦
COPY ./file/entrypoint.sh /root/
#yum update
RUN yum -y update
#nginx설치
RUN yum -y install nginx

#git 설치 혹시 모르니까
RUN yum -y install git
#nodejs설치를 위해서 epel설치 필요
RUN yum -y install epel-release
#웹링크 다운받기 위해서 wget 설치
RUN yum -y install wget
#설치한거 압축 해제해야하니까 zip이랑 unzip설치
RUN yum -y install unzip zip
#들어가서 에디팅 해야할 수 있으니까 vim설치
RUN yum -y install vim
RUN yum -y install tar
# \n\r(윈도우스타일)로 작성된 sh는 리눅스에서 오류가남. \n(posix스타일)로 고쳐야함
RUN yum -y install dos2unix

#nodejs설치
RUN wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.2/install.sh | bash
RUN source /root/.bashrc && nvm install 12

#tomcat설치
WORKDIR /root
RUN wget http://mirror.navercorp.com/apache/tomcat/tomcat-8/v8.5.57/bin/apache-tomcat-8.5.57.tar.gz
RUN tar -xvzf apache-tomcat-8.5.57.tar.gz
RUN rm -rf apache-tomcat-8.5.57.tar.gz
RUN mv apache-tomcat-8.5.57/ tomcat
RUN yum -y install java

#프로젝트 싱크안하고 그냥 넣음
COPY ./project /root/project
#entrypoint line end를 리눅스 스타일로 바꿈
RUN dos2unix /root/entrypoint.sh
#workdir를 임시로 바꾸고 npm install
#RUN cd /root/project/my-react-app && npm install

#외부에 접속가능하게 포트 열어줌
EXPOSE 80 8080

#컨테이너가 켜졌을때 작업시킬 작업, 근데 docker-compose로 열면 docker-compose의 entrypoint나 command가 덮어써서 별로 의미 없음
#docker는 해당 작업을 하고 "종료해버림" 종료 안하려면 포어그라운드에서 작업을 해야함
CMD /root/entrypoint.sh