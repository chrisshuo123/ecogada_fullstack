use ecogada;

/* 1. Insert User (untuk sebatas nama depan dulu) */
insert into user(namaUser)
values ("Melani");

select * from user;

/* 2. Insert Brand (baru yang punya Melani dulu) */
insert into brand(brand)
values ("KayaRempah"),("My Love"),("Susu Murni Ho-Milk");

select * from brand;

/* 3. Insert produk milik */
insert into profil_kerjasama(namaKerjasama)
values("Punya Sendiri"), ("Christian");
insert into profil_kerjasama(namaKerjasama)
values("Sitaan punya Roy");

select * from profil_kerjasama;

/* 4. Insert Kategori Produk */
insert into kategori_produk(kategoriProduk)
values("Makanan"),("Minuman");
insert into kategori_produk(kategoriProduk)
values("Kue Basah"),("Kue Kering"),("Elektronik");
select * from kategori_produk;

/* 5. Insert informasi produk */
/* 
idBrand_fkProduk, idKategoriProduk_fkProduk, deskripsi,
hargaAwal, hargaAkhir, idKondisi_fkProduk, PreOrder (iya aja), dan Status produk (lagi dijual).

Untuk kalau yang ada:
stok
berat */

select * from preOrder;
select * from status_produk;

/* 5.1. Insert 1st Produk untuk Ngetes fungsionalnya */

insert into produk(
    tglRegistrasi,
    idBrand_fkProduk,
    idKategoriProduk_fkProduk,
    deskripsi,
    hargaAwal,
    hargaAkhir,
    stok,
    idKondisi_fkProduk,
    idPreOrder_fkProduk,
    idStatusProduk_fkProduk
)
values
    ('2024-04-09',1,2,'Minuman Teh rasa Teh Frambozen (tak disengaja dibuat, namun memiliki rasa yang kreatif dan keunikan tersendiri) - Ukuran botol 250ml',
    6000,8500,null,1,1,1);
/* Lupa memberi namaProduk */
update produk
SET namaProduk = "Teh Frambozen"
where idProduk = 1;

select * from produk;
describe produk;

/* Hasil: Berhasil! */

/* 5.2. Lanjut Insert Data lainnya lebih lengkap */

/* DATE DataType Format:
    - '2025-10-17'
    idBrand_fkProduk List:
    - KayaRempah (id: 1)
    - My Love (id: 2)
    - Susu Murni Ho-Milk (id: 3)
    idKategoriProduk_fkProduk
    - Makanan (id: 1)
    - Minuman (id: 2)
    - Kue Basah (id: 3)
    - Kue Kering (id: 4)
    - Elektronik (id: 5)
    idKondisi_fkProduk
    - Baru (id: 1)
    - Bekas (id: 2)
    idPreOrder_fkProduk
    - Iya (id: 1)
    - Tidak (id: 2)
    idStatusProduk_fkProduk
    - Lagi Dijual (id: 1)
    - Sedang Tidak Dijual (id: 2)
    - Discontinued (id: 3)  */

select * from produk;

insert into produk(
    tglRegistrasi,
    namaProduk,
    idBrand_fkProduk,
    idKategoriProduk_fkProduk,
    deskripsi,
    hargaAwal,
    hargaAkhir,
    stok,
    idKondisi_fkProduk,
    idPreOrder_fkProduk,
    idStatusProduk_fkProduk
)
values
    ('2024-04-09','Sinom',2,2,'Minuman Variant Sinom yang dititip dari teman ce Melani, ukuran 250ml?',
    5500,7500,null,1,1,1),
    ('2024-04-09','Saridele Original',2,2,'Minuman Variant Saridele Original yang dititip dari teman ce Melani, ukuran 250ml?',
    5000,7000,null,1,1,1),
    ('2024-04-09','Saridele Coklat',2,2,'Minuman Variant Saridele Coklat yang dititip dari teman ce Melani, ukuran 250ml?',
    5000,7000,null,1,1,1),
    ('2024-04-09','Beras Kencur',2,2,'Minuman Beras Kencur yang dititip dari teman ce Melani, ukuran 250ml?',
    5000,7000,null,1,1,1),
    
    ('2024-09-07',"Teh Tarik 'SKM' Kayu Manis Mocha",1,2,'Minuman KayaRempah bikinan ce Melani sendiri',
    8000,10000,null,1,1,1),
    ('2024-09-07',"Teh Tarik 'SKM' Kopi Hitam",1,2,'Minuman KayaRempah bikinan ce Melani sendiri',
    null,null,null,1,1,1),
    ('2024-09-07',"Teh Tarik 'SKM' Kayu Manis Kelapa Kopyor",1,2,'Minuman KayaRempah bikinan ce Melani sendiri',
    8000,10000,null,1,1,1),
    ('2024-09-07',"Teh Orange",1,2,'Minuman KayaRempah bikinan ce Melani sendiri',
    8000,10000,null,1,1,1),
    ('2024-09-07',"Teh Jahe",1,2,'Minuman KayaRempah bikinan ce Melani sendiri',
    null,null,null,1,1,1),
    ('2024-09-07',"Teh Tarik 'SKM' Kayu Manis Lecy",1,2,'Minuman KayaRempah bikinan ce Melani sendiri',
    null,null,null,1,1,1),
    ('2025-09-12',"Jus Alpukat Kopi",1,2,'Minuman KayaRempah bikinan ce Melani sendiri',
    null,null,null,1,1,1),
    /* Susu Murni Ho-Milk */
    ('2024-04-09',"Susu Sapi Murni rasa Vanilla Es Krim",3,2,'Susu sapi murni rasa Vanilla Es Krim McDonald',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Rum",3,2,'Susu sapi murni rasa Rum, terasa lebih kuat berkat Rhumnya',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Coklat",3,2,'Susu sapi murni rasa coklat',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Stroberi",3,2,'Susu sapi murni rasa stroberi',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Mocha",3,2,'Susu sapi murni rasa Mocha',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Melon",3,2,'Susu sapi murni rasa Melon',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Taro",3,2,'Susu sapi murni rasa Taro',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Durian",3,2,'Susu sapi murni rasa Durian',
    7000,null,null,1,1,1),
    ('2024-04-09',"Susu Sapi Murni varian Oranye",3,2,'Susu sapi murni rasa Oranye',
    7000,null,null,1,1,1),

    ('2025-09-01','Daging tanpa telor',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-01','Daging separuh telor',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-01','Daging telur utuh',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-01','Nasi cup bali daging tanpa telur',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-01','Nasi cup bali daging dengan telur separuh',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-01','Nasi cup bali daging dengan telur utuh',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),

    ('2025-09-12','Nasi bungkus krengsengan tanpa telur',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Nasi bungkus krengsengan dengan telur separuh',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Nasi bungkus krengsengan dengan telur utuh',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Nasi cup daging krengsengan tanpa telur',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Nasi cup daging krengsengan telur 1/2',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Nasi cup daging krengsengan telur utuh',null,1,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    
    ('2025-09-01','Kue roti rogut',null,3,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-01','Kroket',null,3,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-01','Risol Sosis Mayo',null,3,'Bisa ce Lengkapi',
    null,null,null,1,1,1),

    ('2025-09-12','Pastel bihun wortel',null,3,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Gabin fla susu',null,4,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Gabin fla coklat',null,4,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Kroket kentang ayam',null,3,'Bisa ce Lengkapi',
    null,null,null,1,1,1),
    ('2025-09-12','Risol mayo sosis benardi',null,3,'Bisa ce Lengkapi',
    null,null,null,1,1,1),

    ('2025-08-22','Laptop Asus Roy Asus Th. 2011',null,5,'Baterai Tanam, ada speaker bluetooth 2',
    null,null,1,2,2,1);

/* Tautkan tabel user, tabel profil_kerjasama, dan tabel produk
ke tabel strategic_partnership (m:n) */

/*
user: melani (id: 1)
profil kerjasama: punya sendiri (id: 1), christian (id: 2), Sitaan punya Roy (id: 3)
*/
select * from user;
select * from profil_kerjasama;
    
insert into strategic_partnership(idUser_fkStrategicPartnership, idProfilKerjasama_fkStrategicPartnership, idProduk_fkStrategicPartnership)
values
    /* Teh Frambozen */
    (1,1,1);

/* Now insert another m:n row: */
insert into strategic_partnership(idUser_fkStrategicPartnership, idProfilKerjasama_fkStrategicPartnership, idProduk_fkStrategicPartnership)
values
    /* Sinom */
    (1,null,2),
    /* Saridele Original */
    (1,null,3),
    /* Saridele Coklat */
    (1,null,4),
    /* Beras Kencur */
    (1,null,5),
    /* Teh Tarik SKM Mocha */
    (1,1,6),
    /* Teh Tarik SKM Kopi Hitam */
    (1,1,7),
    /* Teh Tarik SKM Kelapa */
    (1,1,8),
    /* Teh Orange */
    (1,1,9),
    /* Teh Jahe */
    (1,1,10),
    /* Teh Tarik SKM Lecy */
    (1,1,11),
    /* Jus Alpukat Kopi */
    (1,1,12),
    /* Susu Murni Vanilla Es Krim */
    (1,2,13),
    /* Susu Murni Vanilla Rum */
    (1,2,14),
    /* Susu Murni Coklat */
    (1,2,15),
    /* Susu Murni Stroberi */
    (1,2,16),
    /* Susu Murni Mocha */
    (1,2,17),
    /* Susu Murni Melon */
    (1,2,18),
    /* Susu Murni Taro */
    (1,2,19),
    /* Susu Murni Durian */
    (1,2,20),
    /* Susu Murni Orange */
    (1,2,21),
    /* Daging tanpa telor */
    (1,null,22),
    /* Daging separuh telor */
    (1,null,23),
    /* Daging separuh telor */
    (1,null,24),
    /* Nasi cup bali daging tanpa telur */
    (1,null,25),
    /* Nasi cup bali dgn telur separuh */
    (1,null,26),
    /* Nasi cup bali dgn telur utuh */
    (1,null,27),
    /* Nasi bungkus krengsengan tanpa telur */
    (1,null,28),
    /* Nasi bungkus krengsengan dgn telur separuh */
    (1,null,29),
    /* Nasi bungkus krengsengan dgn telur utuh */
    (1,null,30),
    /* Nasi cup daging krengsengan tanpa telur */
    (1,null,31),
    /* Nasi cup daging krengsengan telur 1/2 */
    (1,null,32),
    /* Nasi cup daging krengsengan telur utuh*/
    (1,null,33),
    /* Kue roti ogut */
    (1,null,34),
    /* kroket */
    (1,null,35),
    /* Risol Sosis Mayo */
    (1,null,36),
    /* Pastel Bihun Wortel */
    (1,null,37),
    /* Gabin Fla Susu */
    (1,null,38),
    /* Gabin Fla Coklat */
    (1,null,39),
    /* Kroket kentang ayam */
    (1,null,40),
    /* Risol Mayo sosis benardi */
    (1,null,41),
    /* Laptop Asus Roy Asus th. 2011 */
    (1,3,42);

select * from strategic_partnership;
DESCRIBE strategic_partnership;

/* And now, using the Left Union to show: */
/* - The User's & His or Her Partner */
/* - The Product (including the details) */
SELECT
    SP.idStrategicPartnership,
    U.namaUser,
    PK.namaKerjasama,
    P.namaProduk,
    P.hargaAwal,
    P.hargaAkhir
FROM
    strategic_partnership as SP
LEFT JOIN
    user as U ON SP.idUser_fkStrategicPartnership = U.idUser
LEFT JOIN
    profil_kerjasama as PK ON SP.idProfilKerjasama_fkStrategicPartnership = PK.idProfilKerjasama
LEFT JOIN
    produk as P ON SP.idProduk_fkStrategicPartnership = P.idProduk;

SELECT idProduk, namaProduk, hargaAwal FROM produk;

select * from profil_kerjasama;
select * from produk;
select * from user;
describe user;
describe profil_kerjasama;
describe produk;