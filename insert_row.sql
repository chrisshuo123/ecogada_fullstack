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