CREATE DATABASE mydb;

CREATE TABLE mydb.user(
  id VARCHAR(100) PRIMARY KEY,
  name VARCHAR (100),
  age INT
);

#create masteruser and grant privileges
create user masteruser@'%' identified by 'masterpassword';
grant all privileges on *.* to masteruser@'%' identified by 'masterpassword';

#replication
grant replication slave on *.* to 'slaveuser'@'%' identified by 'slavepassword';
