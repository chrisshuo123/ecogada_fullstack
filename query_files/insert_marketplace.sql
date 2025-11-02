use ecogada;

/* 1. Insert Marketplace List Here: */
insert into list_marketplace(namaMarketplace)
values ("Toco"),("Tokopedia"),("Tiktokshop"),("Shopee");

select * from list_marketplace;

/* 2. Insert Expedition Details Here: */
insert into ekspedisi(namaEkspedisi)
values("JNE"),("TIKI"),("Wahana"),("J&T Express"),("SiCepat"),("AnterAja"),("Ninja Xpress"),
("POS Indonesia"),("Lion Parcel"),("RPX (Royal Paket Express)"),("Pahala Express"),("SAP Express"),("Dakota Cargo"),("ID Express"),("Solusi Expres"),("JET Express"),("Borzo"),("GrabExpress"),("GoSend");
-- Borzo: dulu dikenal sebagai Dostavista

update ekspedisi
SET namaEkspedisi = "RPX"
WHERE idEkspedisi = 10;

select * from ekspedisi;
describe ekspedisi;

describe jenis_ekspedisi;

insert into jenis_ekspedisi (jenisEkspedisi, deskripsi)
    VALUES
    -- Buat JNE
    ('JNE REG (Regular)', 'Layanan standar dan paling umum'), ('JNE YES (Yakin Esok Sampai)', 'Layanan pengiriman kilat satu hari.'), ('JNE OKE (Ongkos Kirim Ekonomis)', 'Layanan ekonomi dengan harga lebih terjangkau'), ('JNE Super (Khusus barang)', 'Layanan untuk barang-barang besar atau berat'), ('JNE International', 'Layanan pengiriman ke luar negeri'), ('JNE Freight (Kargo)', 'Layanan kargo untuk kiriman volume besar'),
    -- Buat TIKI
    ('TIKI REG (Regular)', 'Layanan Standar'), ('TIKI ONS (Over Night Service)', 'Layanan kilat untuk jarak dekat'),('TIKI SDS (Same Day Service)', 'Layanan sangat kilat dalam hari yang sama'), ('TIKI HDS (Holiday Service)', 'Layanan yang tetap beroperasi di hari libur nasional'), ('TIKI International', 'Layanan pengiriman ke luar negeri'),
    -- Buat Wahana
    ('Layanan Reguler', 'Layanan Standar'), ('Layanan Ekspress', 'Layanan lebih cepat dari reguler'), ('Layanan Logistic', 'Untuk pengiriman barang dalam jumlah besar atau proyek'),
    -- Buat J&T Express
    ('J&T Regular', 'Layanan standar'), ('J&T Next Day (JNT)', 'Layanan pengiriman kilat satu hari'), ('J&T Super', 'Untuk pengiriman barang dengan berat di atas 10 kg atau volume besar'), ('J&T International', 'Layanan pengiriman ke luar negeri'), ('J&T Economy', 'Layanan dengan harga lebih ekonomis'),
    -- Buat SiCepat
    ('REGULAR (SiReg)', 'Layanan standar'), ('BEST (SiBest)', 'Layanan tercepat untuk pengiriman satu hari'), ('GOKIL (SiGil)', 'Layanan pengiriman kilat dengan diskon untuk pelanggan setia'),('SUPER (SiSuper)', 'Untuk kiriman barang besar dan berat'), ('International', 'Layanan pengiriman ke luar negeri'),
    -- Buat AnterAja
    ('Reguler', 'Layanan standar'), ('Express', 'Layanan lebih cepat'), ('Same Day', 'Layanan pengiriman dalam hari yang sama'), ('Cargo', 'Layanan untuk kiriman kargo atau volume besar'),
    -- Buat Ninja Xpress
    ('Ninja Reguler', 'Layanan Standar'), ('Ninja Next Day', 'Layanan pengiriman kilat satu hari'), ('Ninja Same Day', 'Layanan pengiriman dalam hari yang sama'), ('Ninja Super', 'Untuk kiriman barang besar dan berat'), ('Ninja International', 'Layanan pengiriman ke luar negeri'),
    -- Buat POS Indonesia
    ('Pos Reguler', 'Layanan standar dengan jangkauan sangat luas hingga pelosok'), ('Pos Kilat Khusus (PKH)', 'Layanan lebih cepat.'),('Pos Express (Surat Kilat)', 'Untuk pengiriman surat/dokumen penting'), ('Pos Paketpos', 'Layanan paket dengan berbagai pilihan'), ('Pos Cargo', 'Layanan kargo dan logistik'), ('EMS (Express Mail Service)', 'Layanan ekspres internasional'),
    -- Buat Lion Parcel
    ('Lion Parcel Regular', 'Layanan standar'),('Lion Parcel Express', 'Layanan lebih cepat'),('Lion Cargo', 'Layanan kargo udara dan darat. (Memanfaatkan jaringan Lion Air Group)'),
    -- Buat RPX (Royal Paket Express)
    ('RPX Regular', 'Layanan Standar'),('RPX Express', 'Layanan kilat'),('RPX Cargo', 'Layanan logistik dan kargo'),('RPX International', 'Layanan pengiriman internasional'),
    -- Buat Pahala Express
    ('Pahala Regular', 'Layanan standar'),('Pahala Express', 'Layanan lebih cepat'), ('Pahala Cargo', 'Layanan kargo darat dan udara'),
    -- Buat SAP Express
    ('SAP Regular', 'Layanan standar'), ('SAP Express', 'Layanan kilat'), ('SAP Cargo', 'Layanan kargo dan logistik'),
    -- Buat Dakota Cargo
    ('Dakota Cargo', 'Khusus sebagai perusahaan kargo yang melayani pengiriman barang dengan berat mulai dari 10 kg hingga tonase, baik via darat maupun udara.'),
    -- Buat ID Express
    ('ID Express Regular', 'Layanan Standar'), ('ID Express Cargo', 'Layanan untuk kiriman kargo'),
    -- Buat Solusi Express
    ('Solusi Express', 'Fokus pada layanan kargo dan logistik untuk perusahaan, dengan layanan darat, udara, dan laut'),
    -- Buat JET Express
    ('JET Regular', 'Layanan standar'), ('JET Same Day', 'Layanan dalam hari yang sama'), ('JET Next Day', 'Layanan hari berikutnya'), ('JET Cargo', 'Layanan kargo'),
    -- Buat Borzo
    ('Layanan Kurir Instan (On-Demand)', 'Layanan pengantaran dalam kota dalam hitungan jam, bahkan menit. Sangat cocok untuk makanan, dokumen, atau paket mendesak'),
    -- Buat GrabExpress
    ('Grab Same-Day', 'Pick up Paket dalam waktu maksimal -+6-8 jam. Mirip dengan Borzo, layanan ini memanfaatkan pengendara roda dua untuk pengantaran dalam kota yang sangat cepat.'),
    ('Grab Instant Courier', 'Pick up Paket sesegera setelah request pick-up. Mirip dengan Borzo, layanan ini memanfaatkan pengendara roda dua untuk pengantaran dalam kota yang sangat cepat.'),
    -- Buat Go-Send
    ('Go-Send Same-Day', 'Pick up Paket dalam waktu maksimal -+6-8 jam. Mirip dengan Borzo, layanan ini memanfaatkan pengendara roda dua untuk pengantaran dalam kota yang sangat cepat. GoSend juga memiliki GoBox untuk barang yang lebih besar.'),
    ('Go-Send Instant Courier', 'Pick up Paket sesegera setelah request pick-up. Mirip dengan Borzo, layanan ini memanfaatkan pengendara roda dua untuk pengantaran dalam kota yang sangat cepat. GoSend juga memiliki GoBox untuk barang yang lebih besar.');

select * from jenis_ekspedisi;
describe jenis_ekspedisi;


select * from layanan_ekspedisi;
describe layanan_ekspedisi;

-- Sambungkan Ekspedisi sesuai dengan JenisEkspedisi

insert into layanan_ekspedisi(idEkspedisi_fkLayananEkspedisi, idJenisEkspedisi_fkLayananEkspedisi)
    values
    -- id JNE: 1
    (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),
    -- id TIKI: 2
    (2,7),(2,8),(2,9),(2,10),(2,11),
    -- id Wahana: 3
    (3,12),(3,13),(3,14),
    -- id J&T Exp: 4
    (4,15),(4,16),(4,17),(4,18),(4,19),
    -- id SiCepat: 5
    (5,20),(5,21),(5,22),(5,23),
    -- id AnterAja: 6
    (6,24),(6,25),(6,26),(6,27),(6,28),
    -- id NinjaExp: 7
    (7,29),(7,30),(7,31),(7,32),(7,33),
    -- id POS Ind: 8
    (8,34),(8,35),(8,36),(8,37),(8,38),(8,39),
    -- id Lion P.: 9
    (9,40),(9,41),(9,42),
    -- id RPX: 10
    (10,43),(10,44),(10,45),(10,46),
    -- id Pahala Exp: 11
    (11,47),(11,48),(11,49),
    -- id SAP Exp: 12
    (12,50),(12,51),(12,52),
    -- id Dakota Cargo: 13
    (13,53),
    -- id ID Express: 14
    (14,54),(14,55),
    -- id Solusi Express: 15
    (15,56),
    -- id JET Express: 16
    (16,57),(16,58),(16,59),(16,60),
    -- id Borzo: 17
    (17,61),
    -- id GrabExpress: 18
    (18,62),(18,63),
    -- id GoSend: 19
    (19,64),(19,65);

select * from layanan_ekspedisi;
describe layanan_ekspedisi;
select * from ekspedisi;
select * from jenis_ekspedisi;

-- TAMPILKAN SELURUH Ekspedisi, Jenis Ekspedisi beserta Deskripsinya:
SELECT
    L.idLayananEkspedisi,
    E.namaEkspedisi,
    J.jenisEkspedisi,
    J.deskripsi
FROM
    layanan_ekspedisi as L
LEFT JOIN
    ekspedisi as E ON L.idEkspedisi_fkLayananEkspedisi = E.idEkspedisi
LEFT JOIN
    jenis_ekspedisi as J ON L.idJenisEkspedisi_fkLayananEkspedisi = J.idJenisEkspedisi;

-- Ketika user klik salah satu 'detail' (contoh JNE), maka menampilkan detail 'jenisEkspedisi' dan 'deskripsi' beradasarkan idEkspedisi milik JNE (id JNE itu 1).
SELECT L.idLayananEkspedisi, J.jenisEkspedisi, J.deskripsi
    FROM layanan_ekspedisi as L
LEFT JOIN 
    jenis_ekspedisi as J ON L.idJenisEkspedisi_fkLayananEkspedisi = J.idJenisEkspedisi
LEFT JOIN
    ekspedisi as E ON L.idEkspedisi_fkLayananEkspedisi = E.idEkspedisi
WHERE
    E.idEkspedisi = 1;
