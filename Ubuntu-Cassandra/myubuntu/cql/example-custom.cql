not exists create
keyspace packt with replication = {'class':'SimpleStrategy', 'replication_factor': '1'}
                       AND durable_writes = true;
use packt;

create table customer
(
    last_name  TEXT,
    first_name TEXT,
    company    TEXT,
    PRIMARY KEY (last_name, first_name)
);

create type customer_address(
    type TEXT,
    street TEXT,
    city TEXT,
    state TEXT,
    postal_cde TEXT,
    country TEXT
);

ALTER TABLE customer ADD address LIST<FROZEN <customer_address>>;

insert into customer(last_name,first_name,company,address)
values ('Washburne','Hoban','Serenity',[{type:'SHIPPING',street:'98443 32nd Place'}]);