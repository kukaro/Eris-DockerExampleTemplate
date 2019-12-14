::rem window batch

::rem run myubuntu instance
docker build -t myubuntu ./myubuntu/
docker-compose -f ./myubuntu/docker-compose.yml up -d
