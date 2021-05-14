create keyspace packt with replication = {'class':'SimpleStrategy', 'replication_factor': '1'}
                       AND durable_writes = true;
use packt;

create table hi_score
(
    name  TEXT,
    game  TEXT,
    score BIGINT,
    PRIMARY KEY (name, game)
);

insert into hi_score(name, game, score)
values ('Dad', 'Pacman', 1882330);
insert into hi_score(name, game, score)
values ('Dad', 'Burgertime', 222000);
insert into hi_score(name, game, score)
values ('Dad', 'Frogger', 15690);
insert into hi_score(name, game, score)
values ('Dad', 'Joust', 48150);
insert into hi_score(name, game, score)
values ('Connor', 'Pacman', 1882330);
insert into hi_score(name, game, score)
values ('Connor', 'Monkey Kong', 15800);
insert into hi_score(name, game, score)
values ('Connor', 'Frogger', 4220);
insert into hi_score(name, game, score)
values ('Connor', 'Joust', 48850);
insert into hi_score(name, game, score)
values ('Avery', 'Galaga', 28880);
insert into hi_score(name, game, score)
values ('Avery', 'Frogger', 1100);
insert into hi_score(name, game, score)
values ('Avery', 'Joust', 19520);

create table users_by_dept
(
    username   TEXT,
    email      TEXT,
    department TEXT,
    title      TEXT,
    ad_groups  TEXT,
    PRIMARY KEY ( (department), username )
) WITH CLUSTERING ORDER BY (username ASC)
   AND COMPACTION = {'class':'LeveledCompactionStrategy',
            'sstable_size_in_mb':'200'};

insert into users_by_dept(department, username, title, email)
values ('Engineering', 'Dinesh', 'Dev Lead', 'dinesh@piedpiper.com');