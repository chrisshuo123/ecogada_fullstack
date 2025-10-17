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

select * from strategic_partnership;

/* ====================== */
/* = 2 - Table Produk == */
/* ====================== */

/* Dibagian table ini lebih banyak relasi fk nya berhubungan
produk banyak komponen pendukung seperti list brand,
list kategori produk, kondisi (baru, bekas), PreOrder (iya
/ tidak), status, dan pengiriman (yg ini m:n) */

/* 1. Create table Produk */
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

select * from produk;

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

/* 5. Table Status */
create table status(
    idStatus int(10) primary key auto_increment,
    tglInput timestamp not null default current_timestamp,
    status varchar(100) not null
);

insert into status(status)
values("Belum Mulai"),("Dalam Proses"),("Selesai");

select * from status;