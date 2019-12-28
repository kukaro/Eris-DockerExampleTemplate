#!/usr/bin/env bash

#아래 두개가 선행 되야함
#brew cask install homebrew/cask-versions/adoptopenjdk8
#brew install swagger-codegen

rm -rf ./src/main/kotlin/io/swagger
swagger-codegen generate -i http://collector.tromm.dev.daumkakao.io/v2/api-docs -l kotlin-client -o ./swgen
mkdir -p ./src/main/kotlin/io/swagger
mv ./swgen/src/main/kotlin/io/swagger ./src/main/kotlin/io/swagger
rm -rf ./swgen