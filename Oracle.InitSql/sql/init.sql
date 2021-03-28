-- Script to create Oracle's "SCOTT" schema with tables
-- EMP, DEPT, BONUS, SALGRADE, DUMMY. Originally demobld.sql.
--
-- In a format suitable for pasting into RexTester:
-- https://rextester.com/l/oracle_online_compiler
--
drop table dept;
drop table emp;
drop table bonus;
drop table salgrade;
drop table dummy;
create table dept
(
    deptno number(2,0) not null,
    dname  varchar2(14),
    loc    varchar2(13)
);
create table emp
(
    empno    number(4,0) not null,
    ename    varchar2(10),
    job      varchar2(9),
    mgr      number(4,0),
    hiredate date,
    sal      number(7,2),
    comm     number(7,2),
    deptno   number(2,0) not null
);
create table bonus
(
    ename varchar2(10),
    job   varchar2(9),
    sal   number,
    comm  number
);
create table salgrade
(
    grade number,
    losal number,
    hisal number
);
create table dummy
(
    dummy number
);
insert into dummy
values (0);
insert into DEPT (DEPTNO, DNAME, LOC)
select 10, 'ACCOUNTING', 'NEW YORK'
from dummy
union all
select 20, 'RESEARCH', 'DALLAS'
from dummy
union all
select 30, 'SALES', 'CHICAGO'
from dummy
union all
select 40, 'OPERATIONS', 'BOSTON'
from dummy;
insert into emp (EMPNO, ENAME, JOB, MGR, HIREDATE, SAL, COMM, DEPTNO)
select 7839,
       'KING',
       'PRESIDENT',
       null,
       to_date('17-11-1981', 'dd-mm-yyyy'),
       5000,
       null,
       10
from dummy
union all
select 7698,
       'BLAKE',
       'MANAGER',
       7839,
       to_date('1-5-1981', 'dd-mm-yyyy'),
       2850,
       null,
       30
from dummy
union all
select 7782,
       'CLARK',
       'MANAGER',
       7839,
       to_date('9-6-1981', 'dd-mm-yyyy'),
       2450,
       null,
       10
from dummy
union all
select 7566,
       'JONES',
       'MANAGER',
       7839,
       to_date('2-4-1981', 'dd-mm-yyyy'),
       2975,
       null,
       20
from dummy
union all
select 7788,
       'SCOTT',
       'ANALYST',
       7566,
       to_date('13-JUL-87', 'dd-mm-rr') - 85,
       3000,
       null,
       20
from dummy
union all
select 7902,
       'FORD',
       'ANALYST',
       7566,
       to_date('3-12-1981', 'dd-mm-yyyy'),
       3000,
       null,
       20
from dummy
union all
select 7369,
       'SMITH',
       'CLERK',
       7902,
       to_date('17-12-1980', 'dd-mm-yyyy'),
       800,
       null,
       20
from dummy
union all
select 7499,
       'ALLEN',
       'SALESMAN',
       7698,
       to_date('20-2-1981', 'dd-mm-yyyy'),
       1600,
       300,
       30
from dummy
union all
select 7521,
       'WARD',
       'SALESMAN',
       7698,
       to_date('22-2-1981', 'dd-mm-yyyy'),
       1250,
       500,
       30
from dummy
union all
select 7654,
       'MARTIN',
       'SALESMAN',
       7698,
       to_date('28-9-1981', 'dd-mm-yyyy'),
       1250,
       1400,
       30
from dummy
union all
select 7844,
       'TURNER',
       'SALESMAN',
       7698,
       to_date('8-9-1981', 'dd-mm-yyyy'),
       1500,
       0,
       30
from dummy
union all
select 7876,
       'ADAMS',
       'CLERK',
       7788,
       to_date('13-JUL-87', 'dd-mm-rr') - 51,
       1100,
       null,
       20
from dummy
union all
select 7900,
       'JAMES',
       'CLERK',
       7698,
       to_date('3-12-1981', 'dd-mm-yyyy'),
       950,
       null,
       30
from dummy
union all
select 7934,
       'MILLER',
       'CLERK',
       7782,
       to_date('23-1-1982', 'dd-mm-yyyy'),
       1300,
       null,
       10
from dummy;
insert into salgrade
select 1, 700, 1200
from dummy
union all
select 2, 1201, 1400
from dummy
union all
select 3, 1401, 2000
from dummy
union all
select 4, 2001, 3000
from dummy
union all
select 5, 3001, 9999
from dummy;
select ename, dname, job, empno, hiredate, loc
from emp,
     dept
where emp.deptno = dept.deptno
order by ename;
commit;