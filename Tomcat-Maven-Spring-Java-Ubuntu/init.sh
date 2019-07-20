#!/usr/bin/env bash

war='SpringTest-1.0-SNAPSHOT.war'

function mvn_install(){
    cd SpringTest && mvn install
    cd ..
}

mvn_install

#run myubuntu instance
cp ./SpringTest/target/${war} ./myubuntu/
docker build -t myubuntu ./myubuntu/
docker-compose -f ./myubuntu/docker-compose.yml up -d
rm ./myubuntu/${war}
