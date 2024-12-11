CREATE DATABASE kritik_saran;
USE kritik_saran;
CREATE TABLE admin(
    id int auto_increment PRIMARY KEY,
    username varchar(20) not null,
    password varchar(20) not null
);
CREATE TABLE kritik_saran (
    id int auto_increment PRIMARY KEY,
    name varchar(20) not null,
    kritik varchar(255) not null,
    saran varchar(255) not null,
    balasan varchar(255) default null,
    create_at timestamp default current_timestamp
);

INSERT INTO admin(username, password) values ('admin1', 'admin1');