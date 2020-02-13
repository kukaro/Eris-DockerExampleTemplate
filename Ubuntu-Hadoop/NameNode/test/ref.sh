#safemode 꺼버리기
hadoop dfsadmin -safemode leave

hdfs dfs -mkdir names
hdfs dfs -put test/names.csv names

CREATE EXTERNAL TABLE IF NOT EXISTS Names_text(
EmployeeID INT, FirstName STRING, Title STRING,
State STRING, Laptop STRING)
COMMENT 'Employee Names'
ROW FORMAT DELIMITED
FIELDS TERMINATED BY ','
STORED AS TEXTFILE
LOCATION '/user/root/names';

CREATE EXTERNAL TABLE IF NOT EXISTS Names(
EmployeeID INT, FirstName STRING, Title STRING,
State STRING, Laptop STRING)
COMMENT 'Employee Names'
ROW FORMAT DELIMITED
FIELDS TERMINATED BY ','
STORED AS ORC;

INSERT OVERWRITE TABLE Names SELECT * from Names_text;

select * from Names_text;
drop table Names_text;

source .bash_profile
mysql_secure_installation
mysql -uroot -proot -e "create database hive"
schematool -initSchema -dbType mysql --verbose
hive --service hiveserver2 &
hive --service metastore &