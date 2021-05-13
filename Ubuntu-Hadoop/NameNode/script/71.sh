#!/bin/bash
hdfs dfs -mkdir in
hdfs dfs -put /root/test/sample.txt in
yarn jar /root/test/Chapter2/Mapred/build/libs/Mapred-1.0-SNAPSHOT.jar MaxTemperature in output
hdfs dfs -put /root/test/Chapter2/Mapred/ftp.ncdc.noaa.gov/pub/data/noaa/1990/010010-99999-1990 in