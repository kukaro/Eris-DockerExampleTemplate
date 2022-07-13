# Ubuntu sshd zookeeper
주키퍼 노드 사용하는 예제

---

* init.sh를 먼저 실행해서 세노드를 다 띄어준다
* vim /etc/hosts를 사용해서 현재 클러스터 id(순서,1,2,3)별로 ip를 기록한다
    * 아래 참조
```text
192.168.48.2 zookeeper3
192.168.48.3 zookeeper1
192.168.48.4 zookeeper2
```
* 모든 서버에서 zkServer.sh start를 실행한다.

---

#참조

* 도커 네트워크 설정
  * https://sinna94.tistory.com/entry/docker-compose-default-network-subnet-%EC%84%A4%EC%A0%95
  * https://youngmind.tistory.com/entry/%EB%8F%84%EC%BB%A4-%EA%B0%95%EC%A2%8C-3-%EB%8F%84%EC%BB%A4-%EB%84%A4%ED%8A%B8%EC%9B%8C%ED%81%AC-1
  * https://hulint.tistory.com/45
