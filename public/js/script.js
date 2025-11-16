$(function() {
    $('.tombolTambahDataUser').on('click', function() {

        $('#judulModalLabel').html('Tambah Data User Merchantzz');
        $('#tombolData').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/ecogada_fullstack/public/user/tambah');
    });

    $('.tampilModalUbahUser').on('click', function() {
        
        $('#judulModalLabel').html('Ubah Data User Merchant');
        $('#tombolData').html('Ubah Data');
        $('.modal-body form').attr('action', 'http://localhost/ecogada_fullstack/public/user/ubah');
    
        // Bisa klik kanan > inspect > console, klik 'ubah' setiap row, akan menampilkan nomor row sesuai:
        const id = $(this).data('user-id'); //idUser
        console.log('Clicked ID: ', id);
        
        $.ajax({
            url:'http://localhost/ecogada_fullstack/public/user/getUbah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log('Data recieved from server: ', data);
                console.log('id: ', data.id); // ini id yang diatas, dari data-id.
                console.log('idUser: ', data.idUser); // Menyesuaikan id #idUser pada form User View Page
                console.log('Nama Depan: ', data.namaDepan); // Menyesuaikan id #namaDepan pada form User View Page
                console.log('Nama Belakang: ', data.namaBelakang); // Menyesuaikan id #namaBelakang
                console.log('Email: ', data.email); // Menyesuaikan id #email
                console.log('Username: ', data.username); // Menyesuaikan id #username
                console.log('Password: ', data.password); // Menyesuaikan id #password

                // Set form values
                // panggil id dari masing2 form di index.php user bagian Modal, ke sini
                $('#id').val(data.idUser);
                $('#namaDepan').val(data.namaDepan);
                $('#namaBelakang').val(data.namaBelakang);
                $('#email').val(data.email);
                $('#username').val(data.username);
                $('#password').val(data.password);

                // Coba berbagai kemungkinan field ID
                if(data.id) {
                    $('#id').val(data.id);
                    console.log('Set ID from data id: ', data.id);
                } else if (data.idUser) {
                    $('#id').val(data.idUser);
                    console.log('Set ID from data.idMahasiswa: ', data.idUser);
                } else {
                    console.log('No ID field found in data!');
                }

                // Verify form values (UPDATE: cek ID kosongan)
                console.log('Hidden ID values after set: ', $('#id').val());
                console.log("All form values:");
                console.log('ID: ', $('#id').val());
                console.log('Nama Depan: ', $('#namaDepan').val());
                console.log('Nama Belakang: ', $('#namaBelakang').val());
                console.log('Email: ', $('#email').val());
                console.log('Username: ', $('#username').val());
                console.log('Password: ', $('#password').val());
                // Final verify on the hidden ID value:
                console.log("");
                console.log('Final hidden ID value: ', $('#id').val());
            }
        });
    });
});