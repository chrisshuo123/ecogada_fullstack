use ecogada;

/* ====================== */
/* = 1 - Table Profile == */
/* ====================== */

/* 1. Create table user */
CREATE TABLE user (
    idUser int(10) primary key auto_increment,
    tglRegistrasi timestamp not null default current_timestamp,
    namaUser varchar(100) not null
);
/* Rubah namaUser menjadi username */
alter table user
rename column namaUser to username;
/* Tambah column NamaDepan dan NamaBelakang setelah tglRegistrasi
dan password setelah namaUser */
alter table user
add column namaDepan varchar(100) not null after tglRegistrasi,
add column namaBelakang varchar(100) not null after namaDepan,
add column password char(60) after username;
/* Sama tambah column email */
alter table user
add column email varchar(255) unique not null after namaBelakang;

select * from user;

/* 2. Create table profil kerjasama */
CREATE TABLE profil_kerjasama(
    idProfilKerjasama int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    namaKerjasama varchar(100) not null
);

select * from profil_kerjasama;

/* 3. Create table strategic_partnership (m:n) */
CREATE TABLE strategic_partnership (
    idStrategicPartnership int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    idUser_fk int(10),
    idProfilKerjasama_fk int(10),
    idProduk_fk int(10)
);
/* Alter fk name by adding the last with the table name */
alter table strategic_partnership
rename column idUser_fk to idUser_fkStrategicPartnership,
rename column idProfilKerjasama_fk to idProfilKerjasama_fkStrategicPartnership,
rename column idProduk_fk to idProduk_fkStrategicPartnership;

select * from strategic_partnership;

/* Add FK Key for the table strategic_partnership */
alter table strategic_partnership
    ADD CONSTRAINT idUser_fkStrategicPartnership FOREIGN KEY (idUser_fkStrategicPartnership)
    REFERENCES user (idUser),
    ADD CONSTRAINT idProfilKerjasama_fkStrategicPartnership FOREIGN KEY (idProfilKerjasama_fkStrategicPartnership)
    REFERENCES profil_kerjasama (idProfilKerjasama),
    ADD CONSTRAINT idProduk_fkStrategicPartnership FOREIGN KEY (idProduk_fkStrategicPartnership)
    REFERENCES produk (idProduk);

/* ====================== */
/* = 2 - Table Produk == */
/* ====================== */

/* Dibagian table ini lebih banyak relasi fk nya berhubungan
produk banyak komponen pendukung seperti list brand,
list kategori produk, kondisi (baru, bekas), PreOrder (iya
/ tidak), status, dan pengiriman (yg ini m:n) */

/* 1. Create table Produk */
/* Yang seharusnya Null:
idBrand_fkProduk, idKategoriProduk_fkProduk, deskripsi,
hargaAwal, hargaAkhir, stok, idKondisi_fkProduk, berat,
PreOrder, dan Status.
Sementara diset Boleh Null dulu. */
CREATE TABLE produk (
    idProduk int(10) primary key auto_increment,
    tglRegistrasi timestamp not null default current_timestamp,
    idBrand_fk int(10) not null,
    idKategoriProduk_fk int(10) not null,
    deskripsi TEXT not null,
    hargaAwal int(10) not null,
    hargaAkhir int(10) not null,
    stok int(10),
    sku varchar(100),
    idKondisi_fk int(10) not null,
    berat double(10, 2) not null,
    uk_panjang double(10, 2),
    uk_lebar double(10, 2),
    uk_tinggi double(10, 2),
    idPO_fk int(10) not null,
    idStatus_fk int(10) not null
);

/* Rename Product's fk column */
alter table produk
	rename column idBrand_fkProduct to idBrand_fkProduk,
    rename column idKategoriProduk_fk to idKategoriProduk_fkProduk,
    rename column idKondisi_fk to idKondisi_fkProduk,
    rename column idPO_fk to idPreOrder_fkProduk,
    rename column idStatus_fk to idStatus_fkProduk;
/* tglRegistrasi diregister secara manual, sdgkan
tglInput diupdate setelah kita progreskan informasi */
alter table produk
    rename column tglRegistrasi to tglInput;
alter table produk
    add column tglRegistrasi timestamp not null default current_timestamp after idProduk;
/* Menggeserkan tglRegistrasi kekanan after tglInput: */
alter table produk
    modify column tglRegistrasi DATE after tglInput;
/* Lupa rename idStatus_fkProduk ke idStatusProduk_fkProduk */
alter table produk 
    rename column idStatus_fkProduk to idStatusProduk_fkProduk;
/* Lupa memberi kolom 'namaProduk' */
alter table produk
    add column namaProduk varchar(100) not null after tglRegistrasi;

/* Add Constraint on FK column in table 'produk' After finish 
creating additional tables */
alter table produk
    ADD CONSTRAINT idBrand_fkProduk FOREIGN KEY (idBrand_fkProduk)
    REFERENCES brand (idBrand),
    ADD CONSTRAINT idKategoriProduk_fkProduk FOREIGN KEY (idKategoriProduk_fkProduk)
    REFERENCES kategori_produk (idKategoriProduk),
    ADD CONSTRAINT idKondisi_fkProduk FOREIGN KEY (idKondisi_fkProduk)
    REFERENCES kondisi (idKondisi),
    ADD CONSTRAINT idPreOrder_fkProduk FOREIGN KEY (idPreOrder_fkProduk)
    REFERENCES preorder (idPreOrder),
    ADD CONSTRAINT idStatus_fkProduk FOREIGN KEY (idStatus_fkProduk)
    REFERENCES status (idStatus);

/* Set Tabel Produk Not Null to Null untuk sementara waktu */
/* idBrand_fkProduk, idKategoriProduk_fkProduk, deskripsi,
hargaAwal, hargaAkhir, stok, idKondisi_fkProduk, berat,
PreOrder, dan Status. */
alter table produk
modify idBrand_fkProduk int(10) NULL,
modify idKategoriProduk_fkProduk int(10) NULL,
modify deskripsi TEXT NULL,
modify hargaAwal int(10) NULL,
modify hargaAkhir int(10) NULL,
modify stok int(10) NULL,
modify idKondisi_fkProduk int(10) NULL,
modify berat double(10,2) NULL,
modify idPreOrder_fkProduk int(10) NULL,
modify idStatus_fkProduk int(10) NULL;

select * from produk;
describe produk;

/* Tambahan tabel untuk tabel produk: */

/* 1. tabel Brand */
create table brand (
    idBrand int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    brand varchar(100)
);
alter table brand
modify column brand varchar(100) not null;

select * from brand;
describe brand;

/* 2. tabel kategori produk */
create table kategori_produk (
    idKategoriProduk int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    kategoriProduk varchar(100) not null
);
select * from kategori_produk;

/* 3. tabel kondisi (Baru / Bekas) */
create table kondisi (
    idKondisi int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    kondisi varchar(100) not null
);

insert into kondisi(kondisi)
    values ("baru"),("bekas");

UPDATE kondisi
SET kondisi = CASE 
    WHEN idKondisi = 1 THEN 'Baru'
    WHEN idKondisi = 2 THEN 'Bekas'
    ELSE idKondisi  -- Keeps the current value for other rows
END
WHERE idKondisi IN (1,2);

select * from kondisi;

/* 4. table PreOrder */
create table preorder(
    idPreOrder int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    preOrder varchar(100) not null
);

insert into preorder(preOrder)
values("Iya"),("Tidak");

select * from preorder;

/* 5. Table Status untuk Produk */
create table status(
    idStatus int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    status varchar(100) not null
);

insert into status(status)
values("Belum Mulai"),("Dalam Proses"),("Selesai");

/* Rename table 'status' into 'statusProduk' */
ALTER TABLE status
RENAME TO status_produk;
/* And change the column name adjusting with it */
ALTER TABLE status_produk
RENAME COLUMN idStatus to idStatusProduk,
RENAME COLUMN status to statusProduk;

UPDATE status_produk
SET statusProduk = CASE 
    WHEN idStatusProduk = 1 THEN 'Lagi Dijual'
    WHEN idStatusProduk = 2 THEN 'Sedang Tidak Dijual'
    WHEN idStatusProduk = 3 THEN 'Discontinued'
    ELSE idStatusProduk  -- Keeps the current value for other rows
END
WHERE idStatusProduk IN (1,2,3);

select * from status_produk;

/* 6. Table Pengiriman (m:n) */
/* Bagian ini sedikit kompleks berhubungan ekspedisi memiliki
sistem tersendiri yang kompleks.  Contoh: */
/* Ekspedisi: JNE, Jenis Ekspedisi: REG / OKE / YES */
/* Begitupun bagi ekspedisi lainnya seperti SiCepat, 
AnterAja, Kobra Express, dll. */
/* Oleh itu, diperlukan tabel 'Ekspedisi' dan 'jenis_ekspedisi' */

/* 6.1. Table Ekspedisi */
create table ekspedisi(
    idEkspedisi int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    namaEkspedisi varchar(100) not null,
    idJenisEkspedisi_fk int(10)
);
/* Rename Ekspedisi's fk column */
alter table ekspedisi
    rename column idJenisEkspedisi_fk to idJenisEkspedisi_fkEkspedisi;
/* Add constraint fk for table ekspedisi */
alter table ekspedisi
    ADD CONSTRAINT idJenisEkspedisi_fkEkspedisi FOREIGN KEY (idJenisEkspedisi_fkEkspedisi)
    REFERENCES jenis_ekspedisi(idJenisEkspedisi);

select * from ekspedisi;
describe ekspedisi;

-- Drop constraint idJenisEkspedisi_fkEkspedisi, we refine table layanan_ekspedisi to integrate ekspedisi and jenis ekspedisi into one.
alter table ekspedisi
    DROP CONSTRAINT idJenisEkspedisi_fkEkspedisi;
alter table ekspedisi
    drop column idJenisEkspedisi_fkEkspedisi;

/* 6.2. Table Jenis Ekspedisi */
create table jenis_ekspedisi(
    idJenisEkspedisi int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    jenisEkspedisi varchar(100) not null
);

-- Add 'deskripsi' column after column 'jenisEkspedisi' 
alter table jenis_ekspedisi
    add column deskripsi TEXT after jenisEkspedisi;

select * from jenis_ekspedisi;

/* 6.3. Table Layanan Ekspedisi (m:n) */
create table layanan_ekspedisi(
    idLayananEkspedisi int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    idProduk_fkLayananEkspedisi int(10) not null,
    idEkspedisi_fkLayananEkspedisi int(10) not null
);
select * from layanan_ekspedisi;

-- Pasang Constraint FK bagi table layanan_ekspedisi
alter table layanan_ekspedisi
    ADD CONSTRAINT idProduk_fkLayananEkspedisi FOREIGN KEY (idProduk_fkLayananEkspedisi)
    REFERENCES produk(idProduk),
    ADD CONSTRAINT idEkspedisi_fkLayananEkspedisi FOREIGN KEY (idEkspedisi_fkLayananEkspedisi)
    REFERENCES ekspedisi(idEkspedisi);

-- Drop constraint idProduk_fkLayananEkspedisi terlebih dahulu, akan dibuatkan pada Table tersendiri
alter table layanan_ekspedisi
    DROP CONSTRAINT idProduk_fkLayananEkspedisi;

alter table layanan_ekspedisi
    drop column idProduk_fkLayananEkspedisi;
alter table layanan_ekspedisi
    add column idJenisEkspedisi_fkLayananEkspedisi int(10) after idEkspedisi_fkLayananEkspedisi;

alter table layanan_ekspedisi
    ADD CONSTRAINT idJenisEkspedisi_fkLayananEkspedisi FOREIGN KEY (idJenisEkspedisi_fkLayananEkspedisi)
    REFERENCES jenis_ekspedisi(idJenisEkspedisi);

select * from layanan_ekspedisi;
describe layanan_ekspedisi;
select * from jenis_ekspedisi;

/* ============================ */
/* = 3 - Table MP Management == */
/* ============================ */

/* Pertama-tama, bikinlah sekumpulan Table MP
berupa List MP, Foto, dan Status */

/* 1. Tabel Marketplace */
create table list_marketplace(
    idListMarketplace int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    namaMarketplace varchar(100) not null
);
select * from list_marketplace;

/* 2. Tabel Foto */
create table foto(
    idFoto int(10) primary key auto_increment,
    tglUpload timestamp not null default current_timestamp,
    foto blob
);
select * from foto;

/* 3. Tabel Status */
create table status_foto (
    idStatusFoto int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    statusFoto varchar(100) not null
);
select * from status_foto;

/* Bagian ini merupakan Manajemen MP berupa penghubung
m:n terdiri atas tabel 'produk terdaftar di MP', 
'foto pada produk', dan 'status Foto Produk' */

/* 1. table 'produk terdaftar di MP' */
/* m:n antara tabel produk dengan list MP */
/* Prinsip: 1 produk bisa banyak MP (1:n) */
create table produk_terdaftar_di_MP(
    idProdukTerdaftarDiMP int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    idProduk_fkProdukTerdaftarDiMP int(10) not null,
    idListMarketplace_fkProdukTerdaftarDiMP int(10) not null
);

/* Add Constraint for each FKs */
ALTER TABLE produk_terdaftar_di_MP
    ADD CONSTRAINT idProduk_fkProdukTerdaftarDiMP FOREIGN KEY (idProduk_fkProdukTerdaftarDiMP)
    REFERENCES produk(idProduk),
    ADD CONSTRAINT idListMarketplace_fkProdukTerdaftarDiMP FOREIGN KEY (idListMarketplace_fkProdukTerdaftarDiMP)
    REFERENCES list_marketplace(idListMarketplace);

describe produk_terdaftar_di_MP;

/* 2. table 'Foto pada Produk' */
/* m:n antara tabel produk dengan foto */
/* Prinsip: 1 produk bisa banyak foto (1:n) */
create table foto_pada_produk(
    idFotoPadaProduk int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    idProduk_fkFotoPadaProduk int(10) not null,
    idFoto_fkFotoPadaProduk int(10) not null
);

/* Add FK Constraint */
ALTER TABLE foto_pada_produk
    ADD CONSTRAINT idProduk_fkFotoPadaProduk FOREIGN KEY (idProduk_fkFotoPadaProduk)
    REFERENCES produk(idProduk),
    ADD CONSTRAINT idFoto_fkFotoPadaProduk FOREIGN KEY (idFoto_fkFotoPadaProduk)
    REFERENCES foto(idFoto);

select * from foto_pada_produk;
describe foto_pada_produk;

/* 3. table 'Status Foto Produk' */
/* m:n antara tabel produk dengan status */
/* Prinsip: 1 produk hanya 1 status (1:1) */
create table status_foto_produk(
    idStatusFotoProduk int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    idProduk_fkStatusFotoProduk int(10) not null,
    idStatus_fkStatusFotoProduk int(10) not null
);
alter table status_foto_produk
rename column idStatus_fkStatusFotoProduk to idStatusFoto_fkStatusFotoProduk;

/* Add Constraint FK */
ALTER TABLE status_foto_produk
    ADD CONSTRAINT idProduk_fkStatusFotoProduk FOREIGN KEY (idProduk_fkStatusFotoProduk)
    REFERENCES produk(idProduk),
    ADD CONSTRAINT idStatusFoto_fkStatusFotoProduk FOREIGN KEY (idStatusFoto_fkStatusFotoProduk)
    REFERENCES status_foto(idStatusFoto);

select * from status_foto_produk;
describe status_foto_produk;

/*
alter table interaksi
	add constraint idPerusahaan_fkInteraksi foreign key (idPerusahaan_fkInteraksi)
    references perusahaan (idPerusahaan),
    add constraint idProduk_fkInteraksi foreign key (idProduk_fkInteraksi)
    references produk (idProduk);
*/