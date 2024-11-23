<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.3-dist/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/fontawesome-free-6.6.0-web/css/all.min.css') ?>">
        <script src="<?= base_url('assets/jquery-3.7.1.min.js') ?>"></script>
    </head>

    <body class="container p-5">
        <h1 class="text-center">Daftar Pelanggan</h1>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-success mt-5 float-end" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-solid fa-user-plus me-1"></i>tambah</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    <table class="table table-bordered table-striped" id="pelangganTable">
                        <thead>
                            <tr>
                                <th class="col-1 text-center align-middle">NO</th>
                                <th class="col-3 text-center align-middle">Nama Pelanggan</th>
                                <th class="col-2 text-center align-middle">Alamat</th>
                                <th class="col-1 text-center align-middle">Nomor Telepon</th>
                                <th class="col-2 text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="modal fade" id="modalTambah" tabindex="-10" aria-labelledby="#modalTambah">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambah">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="NamaPelanggan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="AlamatPelanggan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Nomor Telephone</label>
                                <div class="col-sm-8">
                                    <input required type="number" class="form-control" id="NoTelpPelanggan">
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary float-end" id="simpanPelanggan">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEdit" tabindex="-10" aria-labelledby="#modalEdit">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-light">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambah">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="NamaPelangganEdit">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="AlamatPelangganEdit">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Nomor Telephone</label>
                                <div class="col-sm-8">
                                    <input required type="number" class="form-control" id="NoTelpPelangganEdit">
                                </div>
                            </div>
                            <button type="button" class="btn btn-warning float-end" id="editPelanggan">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <script src="<?= base_url('assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/fontawesome-free-6.6.0-web/js/all.min.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                function tampil() {
                    $.ajax({
                        url: '<?= base_url('pelanggan/tampil') ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function(hasil) {
                            var produkTabel = $('#pelangganTable tbody')
                            produkTabel.empty()
                            var no = 1
                            hasil.forEach(function(item) {
                                var row = '<tr>' +
                                    '<td class="text-center align-middle">' + no + '</td>' +
                                    '<td class="text-center align-middle">' + item.nama_pelanggan + '</td>' +
                                    '<td class="text-center align-middle">' + item.alamat + '</td>' +
                                    '<td class="text-center align-middle">' + item.no_telp + '</td>' +
                                    '<td class="text-center align-middle">' +
                                    '<button class="btn btn-warning btn-sm editPelanggan" data-id="' + item.id_pelanggan + '" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fa-solid fa-pencil"></i> Edit</button>' +
                                    '<button class="btn btn-danger btn-sm hapusPelanggan ms-2" data-id="' + item.id_pelanggan + '"><i class="fa-solid fa-trash"></i> Hapus</button>' +
                                    '</td>' +
                                    '</td>' + '</tr>'

                                produkTabel.append(row)
                                no++
                            })

                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    })
                }

                tampil()
                $('#simpanPelanggan').on('click', function() {
                    Swal.fire({
                        title: "Tambahkan data?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes"
                    }).then((result) => {
                        $.ajax({
                            url: '<?= base_url('pelanggan/tambah') ?>',
                            type: "POST",
                            data: {
                                nama_pelanggan: $('#NamaPelanggan').val(),
                                alamat: $('#AlamatPelanggan').val(),
                                no_telp: $('#NoTelpPelanggan').val(),
                            },
                            dataType: 'json',
                            success: function(hasil) {

                                if (hasil.status === 'success') {
                                    Swal.fire({
                                        title: hasil.message,
                                        icon: "success"
                                    });
                                    $('#modalTambah').modal('hide');
                                    $('#formTambah')[0].reset()

                                    tampil()
                                } else {
                                    alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors))
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Terjadi kesalahan:' + error)
                            }

                        })
                    })
                })

                $('#pelangganTable').on('click', '.hapusPelanggan', function() {
                    var nomor = $(this).closest('tr').find('td:first').text()
                    var id = $(this).attr('data-id')
                    console.log(id);
                    Swal.fire({
                        title: `Yakin hapus data nomor ${nomor}?`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, hapus data!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= base_url('pelanggan/hapus') ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    'id_pelanggan': id
                                },
                                success: function(hasil) {
                                    Swal.fire({
                                        title: hasil.message,
                                        icon: "success"
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.log('pessan error ' + error);
                                }

                            })
                            tampil()
                        }
                    })

                })

                $('#pelangganTable').on('click', '.editPelanggan', function() {
                    document.getElementById('NamaPelangganEdit').value = $(this).closest('tr').find('td:eq(1)').text()
                    document.getElementById('AlamatPelangganEdit').value = $(this).closest('tr').find('td:eq(2)').text()
                    document.getElementById('NoTelpPelangganEdit').value = $(this).closest('tr').find('td:eq(3)').text()
                    var id = $(this).attr('data-id')
                    $('#editPelanggan').off('click').on('click', function() {
                        Swal.fire({
                            title: "Simpan Perubahan?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Ya"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '<?= base_url('pelanggan/edit') ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        'id_pelanggan': id,
                                        'nama_pelanggan': document.getElementById('NamaPelangganEdit').value,
                                        'alamat': document.getElementById('AlamatPelangganEdit').value,
                                        'no_telp': document.getElementById('NoTelpPelangganEdit').value
                                    },
                                    success: function(hasil) {
                                        $('#modalEdit').modal('hide')
                                        Swal.fire({
                                            title: hasil.message,
                                            icon:'success'
                                        })
                                    },
                                    error: function(xhr, status, error) {
                                        console.log('Error: ' + error);
                                    }
                                })
                                tampil()
                            }
                        });

                    })
                })
            })
        </script>

        <!-- <div style="background-color: black; position: absolute; top: 0; bottom: 0; right: 0; left: 0; color: red; font-size: 50px;">Anda di hack</div> -->
    </body>

    </html>
</body>

</html>