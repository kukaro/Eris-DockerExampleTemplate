FROM ubuntu:latest
MAINTAINER kukaro <justkukaro@naver.com>
RUN apt-get update
RUN apt-get install -y openssh-server
RUN mkdir /var/run/sshd

#set password
RUN echo 'root:root' |chpasswd

#replace sshd_config
RUN sed -ri 's/^#?PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config

#make .ssh
RUN mkdir /root/.ssh

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#install git, vim
RUN apt-get update && apt-get install -y git
RUN apt-get install -y vim

#install nodejs
RUN apt-get install -y nodejs
RUN apt-get install -y npm
RUN apt-get install -y curl

#setting vim
RUN git clone https://github.com/VundleVim/Vundle.vim.git
RUN mkdir -p /root/.vim/bundle
RUN mv Vundle.vim /root/.vim/bundle
RUN echo 'set autoindent\nset cindent\n\nset nu\n\nset ts=4\nset shiftwidth=4\n\nset laststatus=2\nset statusline=\\ %<%l:%v\\ [%P]%=%a\\ %h%m%r\\ %F\\\n\nset autoread\nset paste\nset cindent\nset showmatch\nset autoindent\nset cindent\nset shiftwidth=4\n' >> /root/.vimrc

#install
ENV TZ=Asia/Seoul
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get -y install apache2
RUN apt-get -y install php7.2
RUN apt-get -y install libapache2-mod-php
# RUN a2enmod php7.2

#install c, cpp setting
RUN apt-get -y install g++

EXPOSE 22 80 8080

CMD ["/usr/sbin/sshd", "-D"]
