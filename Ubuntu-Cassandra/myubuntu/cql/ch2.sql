CREATE TABLE user
(
    first_name text,
    last_name  text,
    title      text,
    PRIMARY KEY (last_name, first_name)
);

INSERT INTO user (first_name, last_name, title) VALUES ('Bill', 'Nguyen', 'Br.');

INSERT INTO user (first_name, last_name, title) VALUES ('Will', 'Nguyen', 'Mr.');

INSERT INTO user (first_name, last_name) VALUES ('Bill', 'Nguyen');

INSERT INTO user (first_name, last_name, title) VALUES ('Bill', 'Nguyen', null);


SELECT * from user;

SELECT * FROM user WHERE first_name = 'Bill' ALLOW FILTERING;
SELECT * FROM user WHERE last_name = 'Nguyen';
SELECT * FROM user WHERE title = 'Br.';

SELECT * FROM user WHERE last_name = 'Nguyen' AND first_name = 'Bill';
SELECT * FROM user WHERE first_name = 'Bill' AND last_name = 'Nguyen';

DELETE title FROM user WHERE first_name='Bill';
DELETE title FROM user WHERE last_name='Nguyen';
DELETE title FROM user WHERE last_name='Nguyen' AND first_name='Bill';
DELETE FROM user WHERE last_name='Nguyen' AND first_name='Bill';
DELETE FROM user WHERE last_name='Nguyen';
DELETE FROM user WHERE first_name='Bill';

CREATE TABLE user
(
    first_name text,
    last_name  text,
    middle_initial text,
    title      text,
    PRIMARY KEY (last_name, first_name)
);

INSERT INTO user (first_name, middle_initial, last_name, title) VALUES ('Bill', 'S', 'Nguyen', 'Mr.');
INSERT INTO user (first_name, middle_initial, last_name, title) VALUES ('Bill', 'R', 'Nguyen', 'Mr.');
INSERT INTO user (first_name, middle_initial, last_name) VALUES ('Will', 'Nguyen', 'Mr.');
INSERT INTO user (first_name, last_name, title) VALUES ('Will', 'Nguyen', 'Mr.');


SELECT  first_name, middle_initial, last_name, writetime(first_name), writetime(middle_initial) FROM user;
SELECT  first_name, middle_initial, last_name, writetime(middle_initial), writetime(title) FROM user;

UPDATE user set middle_initial = 'Q' WHERE last_name = 'Nguyen';
UPDATE user USING TIMESTAMP 1567886623298243 set middle_initial = 'Q' WHERE last_name = 'Nguyen';

SELECT  first_name, middle_initial, last_name, ttl(middle_initial) FROM user;
UPDATE user USING TTL 3600 set middle_initial = 'Q' WHERE last_name = 'Nguyen' AND first_name = 'Will';

CREATE TABLE user_visits (user_id uuid PRIMARY KEY, visits counter);
UPDATE user_visits SET visits = visits + 1 WHERE user_id=ebf87fee-b372-4104-8a22-00c1252e3e05;

ALTER TABLE user ADD emails set<text>;
UPDATE user SET emails = {'mary@example.com' }
    WHERE first_name = 'Will' AND last_name = 'Nguyen';


UPDATE user SET emails = emails + {'mary@example.com', 'mary.rodriguez.AZ@gmail.com' }
WHERE first_name = 'Will' AND last_name = 'Nguyen';

SELECT emails FROM user WHERE first_name = 'Mary' AND last_name = 'Rodriguez';

ALTER TABLE user ADD phone_numbers list<text>;
UPDATE user SET phone_numbers = ['1-800-999-9999']
    WHERE first_name = 'Will' AND last_name = 'Nguyen';
UPDATE user SET phone_numbers = phone_numbers + ['1-800-999-9999']
    WHERE first_name = 'Will' AND last_name = 'Nguyen';

ALTER TABLE user ADD login_sessions map<timeuuid, int>;
UPDATE user SET login_sessions = { now(): 13, now(): 18}
    WHERE first_name = 'Will' AND last_name = 'Nguyen';
