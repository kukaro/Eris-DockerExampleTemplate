# 사용법

## script
윈도우에서는 bat을, 맥이나 리눅스는 sh를 사용하면됩니다. 내부의 스크립트는 그냥 콘솔에 직접 쳐도 동작합니다.
* build : 현재 docker project에서 변동사항이 있다면(ADD나 COPY된 파일들의 변경, Dockerfile의 스크립트 수정) 다시 빌드한다.
* run : 빌드 된것을 실행한다. 변동사항이 있을때 build하지 않고 run을 하게되면 변동사항 적용되지 않음
* clean : 현재 실행중인 컨테이너들을 종료하고 지워버린다.(stop후 remove) 컨테이너 변동사항들은 남지않고 초기화 된다.
* exec : 현재 실행중인 컨테이너에 들어간다.(ssh같은 느낌이 됨) 나올때는 exit명령어를 터미널에서 치면 종료합니다.

## 스크립트 내부의 docker-compose, docker 명령어 설명
* docker-compose build : docker-compose.yml파일 내에 build context가 있다면 빌드시킵니다.
* docker-compose up -d : docker-compose.yml파일 내의 모든 docker container들을 일제히 실행시킵니다.
* docker-compose down : docker-compose.yml파일 내의 모든 docker container들을 일제히 종료시키고 삭제합니다.
* docker exec -it <컨테이너 이름> /bin/bash : 현재 실행중인 컨테이너에 접속합니다.

## 그 외 docker 명령어 설명
도커 실행중에 여러 명령어를 실행시킬 수 있습니다. 자주쓰는 명령어를 표시합니다.
* docker ps : 현재 작업중인 프로세스를 보여줍니다.
* docker ps -a : 현재 작업중이거나 멈춰져있는 프로세스를 보여줍니다.
* docker stop <컨테이너 이름> : clean.sh의 작업(docker-compose down)은 모든 컨테이너를 멈추고 삭제합니다. 그러나 이 명령어는 하나의 컨테이너의 작업을 오직 멈추기만 합니다.
* docker rm <컨테이너 이름> : clean.sh의 작업(docker-compose down)은 모든 컨테이너를 멈추고 삭제합니다. 그러나 이 명령어는 하나의 컨테이너의 작업을 오직 삭제하기만 합니다.
* docker build -t <컨테이너 이름> : build.sh의 작업(docker-compose up -d)는 모든 컨테이너를 빌드합니다. 하나만 빌드하고 싶으면 도커 명령어를 사용해합니다. 우리 프로젝트는 도커 컨테이너를 하나만 사용하고 있으므로 사실상 같습니다.

## docker에 대한 몇가지 요소 설명
* Dockerfile의 ADD나 COPY는 외부의 파일을 컨테이너 속으로 넣습니다.
* docker-compose.yml의 volumes는 단순히 파일을 컨테이너로 넣는게 아니라 파일을 동기화시킵니다. 외부의 변동 작업이 내부에 적용되고 역 역시 성립합니다.
* 예를 들자면 컨테이너 내부에서 npm install을 해서 새로운 파일이 추가됬는데 그 파일이 링크가 되있다면 외부에 자동으로 나옵니다.
* 동기화 되고나서부터는 동기화된 파일이 변동되는 즉시 서버에 반영됩니다.
