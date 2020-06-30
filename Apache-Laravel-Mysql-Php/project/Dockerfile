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

#install apache and php
ENV TZ=Asia/Seoul
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get -y install apache2
RUN apt-get -y install php7.2
RUN apt-get -y install libapache2-mod-php
RUN apt-get -y install php-zip
RUN apt-get -y install php-mbstring
RUN apt-get -y install php-xml
RUN apt-get -y install zip
RUN apt-get -y install php-curl
RUN apt-get -y install tree
RUN apt-get -y install php-mysql
RUN apt-get -y install mysql-server
RUN apt-get update && apt-get -y install net-tools
RUN apt-get -y install iputils-ping

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ 
RUN ln -s /usr/local/bin/composer.phar /usr/local/bin/composer
RUN composer global require laravel/installer
RUN ln -s /root/.composer/vendor/bin/laravel /usr/local/bin/laravel
RUN echo "<Directory \"/var/www/html/project/public\">\nOptions Indexes FollowSymLinks\nRequire all granted\nAllowOverride All\n</Directory>" >> /etc/apache2/apache2.conf
RUN sed -ri 's/\/var\/www\/html/\/var\/www\/html\/project\/public/g' /etc/apache2/sites-available/000-default.conf

#set file
ADD ./script /root/script/
RUN touch ~/.vimrc
RUN echo "set nu\n" >> ~/.vimrc
RUN a2enmod rewrite

EXPOSE 22 80 8080

CMD ["/usr/sbin/sshd", "-D"]
