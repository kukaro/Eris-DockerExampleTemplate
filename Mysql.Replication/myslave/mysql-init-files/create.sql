CREATE DATABASE mydb;

CREATE TABLE mydb.user(
  id VARCHAR(100) PRIMARY KEY,
  name VARCHAR (100),
  age INT
);

#create masteruser and grant privileges
create user slaveuser@'%' identified by 'slavepassword';
grant all privileges on mydb.* to slaveuser@'%' identified by 'slavepassword';

#host는 진짜 IP를 적어야함 외부랑 통신하는거임
#logfile과 logpos는 show master status결과를 넣는다.
# change master to
# master_host='10.0.0.4',
# master_user='slaveuser',
# master_password='slavepassword',
# master_log_file='mysql-bin.000003',
# master_log_pos=154,
# master_port=3333;
