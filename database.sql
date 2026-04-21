CREATE DATABASE maba_db;
USE maba_db;

CREATE TABLE admin(
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50),
password VARCHAR(50)
);

INSERT INTO admin VALUES (1,'admin','admin');

CREATE TABLE users(
id INT AUTO_INCREMENT PRIMARY KEY,
nama VARCHAR(100),
email VARCHAR(100),
tgl_lahir DATE,
no_ujian VARCHAR(10),
password VARCHAR(50),
sudah_ujian INT DEFAULT 0
);

CREATE TABLE soal(
id INT AUTO_INCREMENT PRIMARY KEY,
pertanyaan TEXT,
a VARCHAR(100),
b VARCHAR(100),
c VARCHAR(100),
d VARCHAR(100),
jawaban VARCHAR(5)
);

CREATE TABLE hasil_ujian (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  nama VARCHAR(100),
  nilai INT,
  status VARCHAR(50),
  tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SELECT *, RANK() OVER (ORDER BY nilai DESC) as ranking FROM hasil_ujian;

ALTER TABLE soal ADD jawaban_benar ENUM('A','B','C','D');