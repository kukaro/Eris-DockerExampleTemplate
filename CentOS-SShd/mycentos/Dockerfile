FROM centos:latest
MAINTAINER kukaro <justkukaro@naver.com>

RUN yum -y update
RUN yum -y install openssh-server
RUN yum -y install vim

RUN echo 'root:root' |chpasswd

RUN sed -ri 's/^#?PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config
RUN ssh-keygen -t rsa -f /etc/ssh/ssh_host_rsa_key -N ''

EXPOSE 22 80 8080

CMD ["/usr/sbin/sshd", "-D"]

#docker exec <컨테이너명>