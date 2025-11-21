$(document).ready(function() {
    // Reset modal ketika ditutup
    // $('#formModal').on('hidden.bs.modal', function () {
    //     resetModal();
    // });
    
    // Button Coloring Bootstrap class diletakkan disini semua
    // 1 - Modal User
    $('.tombolTambahDataUser').on('click', function() {
        $('#tombolData')
            .removeClass('btn btn-warning')
            .addClass('btn btn-primary');
    });
    $('.tampilModalUbahUser').on('click', function() {
        $('#tombolData')
            .removeClass('btn btn-primary')
            .addClass('btn btn-warning');
    });
    // 2 - Modal Ekspedisi
    $('.tombolTambahDataJenisEkspedisi').on('click', function() {
        $('#tombolData')
            .removeClass('btn btn-warning')
            .addClass('btn btn-primary');
    });
    $('.tombolUbahDataJenisEkspedisi').on('click', function() {
        $('#tombolData')
            .removeClass('btn btn-primary')
            .addClass('btn btn-warning');
    });

    // === HALAMAN USER ===
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
                    console.log('Set ID from data.idUser: ', data.idUser);
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

    // === HALAMAN JENIS EKSPEDISI ===
    
    // 1. Tombol Tambah Jenis Ekspedisi
    $('.tombolTambahDataJenisEkspedisi').on('click', function() {
        resetModal();

        // Kosongkan idJenisEkspedisi utk data baru
        $('#idJenisEkspedisi').val('');

        $('#judulModalLabel').html('Tambah Jenis Layanan ' + $('#ekspedisi-container').data('ekspedisi-nama'));
        $('#jenisEkspedisi').attr('placeholder', 'Input Jenis Layanan dari ' + $('#ekspedisi-container').data('ekspedisi-nama'));
        $('#deskripsi').attr('placeholder', 'Input Deskripsi dari ' + $('#ekspedisi-container').data('ekspedisi-nama'));
        $('#tombolData').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/ecogada_fullstack/public/ekspedisi/tambahJenisEkspedisi');

        // // Set idEkspedisi utk tambah
        $('#idEkspedisiModal').val($('#ekspedisi-container').data('ekspedisi-id'));

        // Tampilkan field normal, sembunyikan dropdown pindah
        $('#labelJenisEkspedisi').show();
        $('#jenisEkspedisi').show();
        $('#labelDeskripsi').show();
        $('#deskripsi').show();
        $('#panelDropdownEkspedisi').hide(); // ganti .css('display', 'block') dengan show()

        // DEBUG
        console.log('TAMBAH - idJenisEkspedisi: ', $('#idJenisEkspedisi').val());
        console.log('TAMBAH - idEkspedisi: ', $('#idEkspedisiModal').val());
    });

    
    
    
    // 2. Pindah Jenis Ekspedisi

    // Bikin debug terlebih dahulu
    $(document).on('submit', '#formModal form', function(e) {
        // e.preventDefault(); // Matikan saat tidak debug
        console.log('=== FORM SUBMIT DEBUG ===');

        // GET semua form values
        var formData = $(this).serializeArray();
        console.log('All form data: ', formData);

        // Debug dropdown value
        var dropdownId = $('#comboboxSelect').val();
        var dropdownName = $('#comboboxSelect option:selected').text();
        console.log('Dropdown ID: ' + dropdownId + ', Dropdown Name: ' + dropdownName);

        // Debug hidden fields
        console.log('Hidden ID: ', $('#id').val());
        console.log('Hidden idJenisEkspedisi: ', $('#idJenisEkspedisi').val());
        console.log('Hidden idEkspedisi: ', $('#idEkspedisi').val());

        console.log('==================================================');
    });

    // Tombol ubah
    $('.tombolUbahDataJenisEkspedisi').on('click', function() {
        resetModal();
        var jenisEkspedisi = $(this).data('ekspedisi-nama');
        var deskripsi = $(this).data('deskripsi');

        $('#judulModalLabel').html('Ubah Jenis Layanan ' + jenisEkspedisi);
        $('#jenisEkspedisi').attr('placeholder', 'Ubah Jenis Layanan dari ' + jenisEkspedisi);
        $('#deskripsi').attr('placeholder', 'Ubah Deskripsi dari ' + jenisEkspedisi);
        $('#tombolData').html('Ubah Data');
        $('#formModalEkspedisi').attr('action', 'http://localhost/ecogada_fullstack/public/ekspedisi/ubahJenisEkspedisi');

        const idJenisEkspedisi = $(this).data('id');
        //const id = $(this).data('user-id'); //idJenisEkspedisi
        console.log('Clicked ID: ', idJenisEkspedisi);

        // AJAX untuk ambil data dari server
        $.ajax({
            url: 'http://localhost/ecogada_fullstack/public/ekspedisi/getUbahJenisEkspedisi',
            data: {idJenisEkspedisi: idJenisEkspedisi},
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log('Data recieved from server: ', data);
                console.log('id: ', data.id);
                console.log('idJenisEkspedisi: ', data.idJenisEkspedisi);
                console.log('Jenis Ekspedisi: ', data.jenisEkspedisi);
                console.log('Deskripsi: ', data.deskripsi);

                // Set form values
                // Panggil id dari masing2 form di ekspedisi/detail.php ekspedisi bagian Modal, ke sini
                $('#id').val(data.id);
                $('#idJenisEkspedisi').val(data.idJenisEkspedisi);
                $('#jenisEkspedisi').val(data.jenisEkspedisi);
                $('#deskripsi').val(data.deskripsi);
                $('#idEkspedisiModal').val($('#ekspedisi-container').data('ekspedisi-id'));
            
                // Tampilkan field normal, sembunyikan dropdown pindah
                $('#labelJenisEkspedisi').show();
                $('#jenisEkspedisi').show();
                $('#labelDeskripsi').show();
                $('#deskripsi').show();
                $('#panelDropdownEkspedisi').hide(); // ganti .css('display', 'block') dengan show()
            
                // Coba berbagai kemungkinan field ID
                console.log('Pengecekan untuk ID Jenis Ekspedisi:');
                if(data.id) {
                    $('#id').val(data.id);
                    console.log('Set ID Jenis Ekspedisi from data id: ', data.id);
                } else if(data.idJenisEkspedisi) {
                    $('#idJenisEkspedisi').val(data.idJenisEkspedisi);
                    console.log('Set ID Jenis Ekspedisi from data idJenisEkspedisi: ', data.idJenisEkspedisi);
                } else {
                    console.log('No ID Jenis Ekspedisi field found in data!');
                }

                console.log("");
                console.log("Pengecekan untuk ID Ekspedisi: ");
                if(data.id) {
                    $('#id').val(data.id);
                    console.log('Set ID Ekspedisi from data id: ', data.id);
                } else if(data.idJenisEkspedisi) {
                    $('#idJenisEkspedisi').val(data.idJenisEkspedisi);
                    console.log('Set ID Ekspedisi from data idEkspedisi: ', data.idEkspedisi);
                } else {
                    console.log('No ID Ekspedisi field found in data!');
                }

                // Verify form values (UPDATE: cek ID kosongan)
                console.log('Hidden ID values after set: ', $('#id').val());
                console.log('All form values:');
                console.log('ID: ', $('#id').val());
                console.log('idJenisEkspedisi: ', $('#idJenisEkspedisi').val());
                console.log('Jenis Ekspedisi: ', $('#jenisEkspedisi').val());
                console.log('Deskripsi: ', $('#deskripsi').val());
                console.log('ID Ekspedisi: ', $('#idEkspedisi').val());
                // Final verify on the hidden ID value:
                console.log("");
                console.log('Final hidden ID value: ', $('#id').val());
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', error);
            }
        });

        

        
    });

    // Tombol pindah
    $('.tombolPindahDataJenisEkspedisi').on('click', function() {
        resetModal();
        // Get the nama ekspedisi from the data attribute
        var idJenisEkspedisi = $(this).data('id');
        var currentEkspedisiId = $('#ekspedisi-container').data('ekspedisi-id'); // Makesure this data attribute exists
        var namaEkspedisi = $('#ekspedisi-container').data('ekspedisi-nama');

        console.log("=== BUTTON CLICK DEBUG ===");
        console.log('Button data-id: ', idJenisEkspedisi);
        console.log('Container ekspedisi-id: ', currentEkspedisiId);
        console.log('Container ekspedisi-nama: ', namaEkspedisi);
        
        // Validate data
        if(!idJenisEkspedisi) {
            console.error('idJenisEkspedisi is missing!');
            alert('Error: ID Jenis Ekspedisi tidak ditemukan');
            return;
        }

        if(!currentEkspedisiId) {
            console.error('currentEkspedisiId is missing!');
            alert('Error: ID Ekspedisi saat ini tidak ditemukan');
            return;
        }

        // Update modal UI
        $('#judulModalLabel').html('Pindah Jenis Layanan ' + namaEkspedisi);
        $('#tombolData').html('Pindah Data');
        // $('.modal-body form').attr('action', 'http://localhost/ecogada_fullstack/public/ekspedisi/pindahDataJenisEkspedisi');

        // Set hidden fields with the correct values
        $('#idJenisEkspedisi').val(idJenisEkspedisi);
        $('#idEkspedisiModal').val(currentEkspedisiId);

        // Show/hide form elements:
        $('#labelJenisEkspedisi').hide();
        $('#jenisEkspedisi').hide();
        $('#labelDeskripsi').hide();
        $('#deskripsi').hide();
        $('#panelDropdownEkspedisi').show(); // ganti .css('display', 'block') dengan show()
        
        // Load current ekspedisi data for the jenis ekspedisi
        $.ajax({
            url: 'http://ecogada_fullstack/public/ekspedisi/getIdEkspedisi',
            data: {idJenisEkspedisi: idJenisEkspedisi},
            method: 'POST',
            dataType: 'json',
            success: function(ekspedisiData) {
                console.log('=== DROPDOWN INITIALIZATION ===')
                console.log('Ekspedisi Data from Server: ', ekspedisiData);

                if(ekspedisiData && ekspedisiData.idEkspedisi) {
                    $('#comboboxSelect').val(ekspedisiData.idEkspedisi);
                    var selectedName = $('#comboboxSelect option:selected').text();
                    console.log('Dropdown initialized to - ID: ', ekspedisiData.idEkspedisi, 'Name: ', selectedName);
                } else {
                    // Fallback to current ekspedisi
                    $('#comboboxSelect').val(currentEkspedisiId);
                    var fallbackName = $('#comboboxSelect option:selected').text();
                    console.log('Fallback to - ID: ', currentEkspedisiId, 'Name: ', fallbackName);
                }
                console.log('============================');
            },
            error: function(xhr, status, error) {
                console.log('Error getting ekspedisi data: ', error);
                console.log('Response: ', xhr.responseText);
                // Fallback to current ekspedisi
                $('#comboboxSelect').val(currentEkspedisiId);
            }
        });
    });

    // Form Submission Handler
    // $('#formModalEkspedisi').on('submit', function(e) {
    //     e.preventDefault();
        
    //     var formAction = $(this).attr('action');
    //     var formData = $(this).serialize();

    //     console.log('Form Action: ', formAction);
    //     console.log('Form Data: ', formData);

    //     // Check if this is pindah operation (dropdown is visible)
    //     if($('#panelDropdownEkspedisi').is(':visible')) {
    //         // Handle pindah operation seperately
    //         console.log('Pindah operation detected');
    //         handlePindahSubmit(formData);
    //         return;
    //     }

    //     console.log('Tambah/Ubah Operation');

    //     // Handle tambah / ubah operation
    //     $.ajax({
    //         url: formData,
    //         method: 'POST',
    //         data: formData,
    //         // data: {idJenisEkspedisi : id},
    //         success: function(response) {
    //             console.log('AJAX Success: ', response);
    //             $('#formModal').modal('hide');
    //             // Don't reload yet - check Response First

    //             // your custom success handler
    //             var data = typeof response === 'string' ? JSON.parse(response) : response;

    //             // Set form values - SAMA SEPERTI DI USER
    //             $('#id').val(data.idJenisEkspedisi);
    //             $('#idJenisEkspedisi').val(data.idJenisEkspedisi);
    //             $('#jenisEkspedisi').val(data.jenisEkspedisi);
    //             $('#deskripsi').val(data.deskripsi);
    //             $('#idLayananEkspedisi').val(data.idJenisEkspedisi);
    //             $('#idEkspedisi_fkLayananEkspedisi').val($('#idEkspedisiModal').val());

    //             // Set temporary utk dropdown (akan diupdate oleh ajax kedua)
    //             $('#comboboxSelect').val(currentEkspedisiId);

    //             console.log('All form values set');
    //             // Set form values
    //             // panggil id dari masing2 form di detail.php user bagian Modal, ke sini
    //             console.log('Form values after set:');
    //             console.log('ID: ', $('#id').val());
    //             console.log('Jenis Ekspedisi: ', $('#jenisEkspedisi').val());
    //             console.log('Deskripsi: ', $('#deskripsi').val());
    //             // Final verify on the hidden ID value:
    //             console.log("");
    //             console.log('Final hidden ID value: ', $('#idEkspedisiModal').val());

    //             // Coba berbagai kemungkinan field ID
    //             if(data.id) {
    //                 $('#idEkspedisiModal').val(data.id);
    //                 console.log('Set ID from data id: ', data.id);
    //             } else if (data.idJenisEkspedisi) {
    //                 $('#idEkspedisiModal').val(data.idJenisEkspedisi);
    //                 console.log('Set ID from data.idEkspedisi: ', data.idJenisEkspedisi);
    //             } else {
    //                 console.log('No ID field found in data!');
    //             }

    //             $('#formModal').modal('hide');
    //             location.reload(); // Reload page to see changes
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('AJAX Error:', error);
    //             console.log('Status:', status);
    //             console.log('Response:', xhr.responseText);
    //             alert('Error: ' + (xhr.responseText || error));
    //             // Stay on page to see error
    //         }
    //     });

    //     return false;
    // });

    // function handlePindahSubmit(formData) {
    //     console.log('=== FORM SUBMIT DEBUG (PINDAH) ===');

    //     // GET semua form values
    //     var formArray = $('#formModalEkspedisi').serializeArray();
    //     console.log('All form data: ', formArray);

    //     // Debug dropdown value
    //     var dropdownId = $('#comboboxSelect').val();
    //     var dropdownName = $('#comboboxSelect option:selected').text();
    //     console.log('Dropdown ID: ' + dropdownId + ', Dropdown Name: ' + dropdownName);

    //     // Debug hidden fields
    //     console.log('Hidden ID: ' + $('#id').val());
    //     console.log('Hidden idJenisEkspedisi: ' + $('#idJenisEkspedisi').val());
    //     console.log('Hidden idEkspedisi: ' + $('#idEkspedisiModal').val());

    //     console.log('================================');

    //     // Submit the pindah form via AJAX
    //     $.ajax({
    //         url: 'http://ecogada_fullstack/public/ekspedisi/pindahJenisEkspedisi',
    //         method: 'POST',
    //         data: formData,
    //         success: function(response) {
    //             console.log('Success: ', response);

    //             // Your custom success handler for pindah
    //             var data = typeof response === 'string' ? JSON.parse(response) : response;

    //             // Set form values - SAMA SEPERTI DI USER
    //             $('#id').val(data.idJenisEkspedisi);
    //             $('#idJenisEkspedisi').val(data.idJenisEkspedisi);
    //             $('#jenisEkspedisi').val(data.jenisEkspedisi);
    //             $('#deskripsi').val(data.deskripsi);
    //             $('#idLayananEkspedisi').val(data.idJenisEkspedisi);
    //             $('#idEkspedisi_fkLayananEkspedisi').val($('#idEkspedisiModal').val());

    //             // Set temporary utk dropdown (akan diupdate oleh ajax kedua)
    //             var currentEkspedisiId = $('#ekspedisi-container').data('ekspedisi-id');
    //             $('#comboboxSelect').val(currentEkspedisiId);

    //             console.log('All form values set');
    //             console.log('Form values after set:');
    //             console.log('ID: ', $('#id').val());
    //             console.log('Jenis Ekspedisi: ', $('#jenisEkspedisi').val());
    //             console.log('Deskripsi: ', $('#deskripsi').val());
    //             console.log('Final hidden ID value: ', $('#idEkspedisiModal').val());
            
    //             // Coba berbagai kemungkinan field ID
    //             if(data.id) {
    //                 $('#idEkspedisiModal').val(data.id);
    //                 console.log('Set ID from data id: ', data.id);
    //             } else if(data.idJenisEkspedisi) {
    //                 $("#idEkspedisiModal").val(data.idJenisEkspedisi);
    //                 console.log('Set ID from data idJenisEkspedisi: ', data.idJenisEkspedisi);
    //             } else {
    //                 console.log('No ID field found in data!');
    //             }
                
    //             $('#formModal').modal('hide');
    //             location.reload(); // Reload page to see changes
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('AJAX Error: ',error);
    //             console.log('Status: ', status);
    //             console.log('Response: ', xhr.responseText);
    //             alert('Error: ' + (xhr.responseText || error));
    //         }
    //     });
    // }

    function resetModal() {
        $('#idJenisEkspedisi').val('');
        $('#jenisEkspedisi').val('');
        $('#deskripsi').val('');
        $('#comboboxSelect').val($('#ekspedisi-container').data('ekspedisi-id'));
        // Reset form action
        $('#formModalEkspedisi').attr('action', '');
    }

    // Handle delete confirmation Khusus jenisEkspedisi
    $('.tombolHapusJenisEkspedisi').on('click', function(e) {
        e.preventDefault();
        var namaLayanan = $(this).data('nama');
        var deleteUrl = $(this).attr('href');

        if(confirm('Yakin mau hapus jenis ekspedisi "' + namaLayanan + '" ini?')) {
            window.location.href = deleteUrl;
        }
    });
});


