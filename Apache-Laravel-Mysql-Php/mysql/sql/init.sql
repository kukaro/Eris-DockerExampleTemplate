-- DROP DATABASE mydb;

CREATE DATABASE td_db;

use td_db;

CREATE TABLE user(
    email VARCHAR(100) PRIMARY KEY,
    name VARCHAR (100) NOT NULL,
    age INT NOT NULL,
    birth_date DATETIME NOT NULL,
    password VARCHAR(100) NOT NULL,
    created_date DATETIME NOT NULL,
    updated_date DATETIME NOT NULL
);

CREATE TABLE picture(
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner_email VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    path VARCHAR(100) NOT NULL,
    created_date DATETIME NOT NULL,
    updated_date DATETIME NOT NULL
);

ALTER TABLE picture ADD CONSTRAINT fk_picture_owneremail_user_email 
    FOREIGN KEY (owner_email) REFERENCES user(email);

CREATE TABLE usergroup(
    id INT PRIMARY KEY,
    owner_email VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_date VARCHAR(100) NOT NULL
);

ALTER TABLE usergroup ADD CONSTRAINT fk_usergroup_owneremail_user_email
    FOREIGN KEY (owner_email) REFERENCES user(email);

CREATE TABLE usergroup_user(
    id INT PRIMARY KEY,
    usergroup_id INT NOT NULL,
    user_email varchar(100) NOT NULL
);

ALTER TABLE usergroup_user ADD CONSTRAINT fk_usergroupuser_usergroupid_usergroup_id
    FOREIGN KEY (usergroup_id) REFERENCES usergroup(id);

ALTER TABLE usergroup_user ADD CONSTRAINT fk_usergroupuser_useremail_user_email
    FOREIGN KEY (user_email) REFERENCES user(email);

-- select * from information_schema.table_constraints where constraint_schema = 'td_db';

CREATE TABLE picture_user(
    id INT PRIMARY KEY,
    picture_id INT NOT NULL,
    user_email VARCHAR(100) NOT NULL
);

ALTER TABLE picture_user ADD CONSTRAINT fk_pictureuser_picture
    FOREIGN KEY (picture_id) REFERENCES picture(id);

ALTER TABLE picture_user ADD CONSTRAINT fk_pictureuser_user
    FOREIGN KEY (user_email) REFERENCES user(email);


CREATE TABLE picture_usergroup(
    id INT PRIMARY KEY,
    picture_id INT NOT NULL,
    usergroup_id INT NOT NULL
);

ALTER TABLE picture_usergroup ADD CONSTRAINT fk_pictureusergroup_picture
    FOREIGN KEY (picture_id) REFERENCES picture(id);

ALTER TABLE picture_usergroup ADD CONSTRAINT fk_pictureusergroup_usergroup
    FOREIGN KEY (usergroup_id) REFERENCES usergroup(id);

CREATE TABLE comment(
    id INT PRIMARY KEY,
    owner_email VARCHAR(100) NOT NULL,
    contents VARCHAR(1000) NOT NULL,
    created_data VARCHAR(100) NOT NULL,
    last_modified_date VARCHAR(100) NOT NULL,
    parents_comment_id INT DEFAULT NULL
);

CREATE TABLE post(
    id INT PRIMARY KEY,
    owner_email VARCHAR(100) NOT NULL,
    contents TEXT NOT NULL,
    created_data VARCHAR(100) NOT NULL,
    last_modified_date VARCHAR(100) NOT NULL,
    parents_post_id INT DEFAULT NULL
);

CREATE TABLE post_picture(
    id INT PRIMARY KEY,
    post_id INT NOT NULL,
    picture_id INT NOT NULL
);

ALTER TABLE post_picture ADD CONSTRAINT fk_postpicturet_post
    FOREIGN KEY (post_id) REFERENCES post(id);

ALTER TABLE post_picture ADD CONSTRAINT fk_postpicture_picture
    FOREIGN KEY (picture_id) REFERENCES picture(id);

CREATE TABLE post_comment(
    id INT PRIMARY KEY,
    post_id INT NOT NULL,
    comment_id INT NOT NULL
);
ALTER TABLE post_comment ADD CONSTRAINT fk_postcomment_post
    FOREIGN KEY (post_id) REFERENCES post(id);

ALTER TABLE post_comment ADD CONSTRAINT fk_postcomment_comment
    FOREIGN KEY (comment_id) REFERENCES comment(id);
