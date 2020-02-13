FROM sequenceiq/hadoop-docker

RUN rpm --rebuilddb && yum -y install vim

RUN rpm --rebuilddb && yum -y install httpd

#setting vim
RUN rpm --rebuilddb && yum -y install git
RUN rpm --rebuilddb && yum -y install wget
RUN wget http://springdale.math.ias.edu/data/puias/computational/6/x86_64/git-1.8.3.1-1.sdl6.x86_64.rpm
RUN wget http://springdale.math.ias.edu/data/puias/computational/6/x86_64/perl-Git-1.8.3.1-1.sdl6.noarch.rpm
RUN yum remove git -y
RUN rpm --rebuilddb && yum localinstall git-*.rpm perl-Git-*.noarch.rpm -y
RUN rpm --rebuilddb && yum update -y nss curl
RUN git clone https://github.com/VundleVim/Vundle.vim.git
RUN mkdir -p /root/.vim/bundle
RUN mv Vundle.vim /root/.vim/bundle
ADD .vimrc /root/
RUN vim -c 'PluginInstall' -c 'qa!'
RUN rm -rf *.rpm

#add script
COPY script /root/script/
COPY .vimrc /root

#mysql
RUN rpm --rebuilddb && yum -y install mysql-server

WORKDIR /root

#hive
RUN wget https://archive.apache.org/dist/hive/hive-2.3.0/apache-hive-2.3.0-bin.tar.gz
RUN tar -xvzf apache-hive-2.3.0-bin.tar.gz
RUN rm apache-hive-2.3.0-bin.tar.gz
RUN mv apache-hive-2.3.0-bin hive
RUN cp ./hive/conf/hive-env.sh.template ./hive/conf/hive-env.sh
RUN sed -i 's/# HADOOP_HOME=\${bin}\/..\/..\/hadoop/HADOOP_HOME=\/usr\/local\/hadoop/g' /root/hive/conf/hive-env.sh
RUN wget https://dev.mysql.com/get/Downloads/Connector-J/mysql-connector-java-5.1.48.tar.gz
RUN tar -xvzf mysql-connector-java-5.1.48.tar.gz
RUN rm mysql-connector-java-5.1.48.tar.gz
RUN mv mysql-connector-java-5.1.48/*.jar ./hive/lib
RUN rm -rf mysql-connector-java-5.1.48
COPY hive-site.xml /root/hive/conf

RUN echo 'export HADOOP_HOME="/usr/local/hadoop"' >> .bash_profile
RUN echo 'export PATH=$PATH:$HADOOP_HOME/bin' >> .bash_profile
RUN echo 'export PATH=$PATH:$HADOOP_HOME/sbin' >> .bash_profile
RUN echo 'export PATH=$PATH:/usr/java/default/bin' >> .bash_profile
RUN echo 'export HIVE_HOME="/root/hive"' >> .bash_profile
RUN echo 'export PATH=$PATH:$HIVE_HOME/bin' >> .bash_profile
RUN source /root/.bash_profile
RUN chmod -R 777 /root/script

EXPOSE 22 80 8080

CMD ["/root/script/init.sh", "-D"]