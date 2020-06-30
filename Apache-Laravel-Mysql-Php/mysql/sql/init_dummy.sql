-- DROP DATABASE mydb;
use td_db;

INSERT INTO user(email, name, age, birth_date, password, created_date, updated_date) values('dudu@dudu.du', '돌쇠', 23, '2008-01-01 00:00:01', '1234', '2008-01-01 00:00:01', '2008-01-01 00:00:01');
INSERT INTO user(email, name, age, birth_date, password, created_date, updated_date) values('dada@dada.da', '놀부', 32, '2008-01-02 00:00:01', '2345', '2008-01-01 00:00:01', '2008-01-01 00:00:01');
INSERT INTO user(email, name, age, birth_date, password, created_date, updated_date) values('didi@didi.di', '길동', 42, '2008-01-03 00:00:01', '3456', '2008-01-01 00:00:01', '2008-01-01 00:00:01');
INSERT INTO user(email, name, age, birth_date, password, created_date, updated_date) values('dydy@dydy.dy', '동길', 53, '2008-01-04 00:00:01', '4567', '2008-01-01 00:00:01', '2008-01-01 00:00:01');

INSERT INTO picture(owner_email, location, path, created_date, updated_date) values('dudu@dudu.du', '아이티', 'http://google.com', '2008-01-01 00:00:01', '2008-01-01 00:00:01');
INSERT INTO picture(owner_email, location, path, created_date, updated_date) values('dudu@dudu.du', '소말리아', 'http://google2.com', '2008-01-01 00:00:01', '2008-01-01 00:00:01');
INSERT INTO picture(owner_email, location, path, created_date, updated_date) values('dada@dada.da', '르완다', 'http://naver.com', '2008-01-01 00:00:01', '2008-01-01 00:00:01');