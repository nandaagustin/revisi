CREATE DATABASE kritik_saran;
USE kritik_saran;
CREATE TABLE admin(
    id int auto_increment PRIMARY KEY,
    username varchar(20) not null,
    password varchar(20) not null
);
CREATE TABLE kritik_saran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(20) NOT NULL,
    kritik VARCHAR(255) NOT NULL,
    saran VARCHAR(255) NOT NULL,
    gambar VARCHAR(255) DEFAULT NULL,
    balasan VARCHAR(255) DEFAULT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admin(username, password) values ('admin1', 'admin1');