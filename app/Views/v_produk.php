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
    <h1 class="text-center">Daftar Produk</h1>
    <div class="row">
        <div class="col-12">
            <button class="btn btn-success mt-5 float-end" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-solid fa-cart-plus me-1"></i>tambah</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <table class="table table-bordered table-striped" id="produkTable">
                    <thead>
                        <tr>
                            <th class="col-1 text-center align-middle">NO</th>
                            <th class="col-3 text-center align-middle">Nama Produk</th>
                            <th class="col-2 text-center align-middle">Harga</th>
                            <th class="col-1 text-center align-middle">Stok</th>
                            <th class="col-3 text-center align-middle">Gambar</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input required type="text" class="form-control" id="NamaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input required type="number" class="form-control" id="HargaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input required type="number" class="form-control" id="StokProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Gambar</label>
                            <div class="col-sm-8">
                                <input required type="file" class="form-control" id="GambarProduk">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-end" id="simpanProduk">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-10" aria-labelledby="#modalEdit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input required type="text" class="form-control" id="NamaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input required type="number" class="form-control" id="HargaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input required type="number" class="form-control" id="StokProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Gambar <div style="font-size: 12px;">(Kosongkan jika tidak ingin mengubah gambar)</div></label>
                            <div class="col-sm-8">
                                <input required type="file" class="form-control" id="GambarProdukEdit" aria-label="Upload">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-end" id="EditProduk">Simpan</button>
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
                    url: '<?= base_url('produk/tampil') ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status == 'success') {
                            var produkTabel = $('#produkTable tbody')
                            produkTabel.empty()
                            var produk = hasil.produk
                            var no = 1
                            produk.forEach(function(item) {
                                var row = '<tr>' +
                                    '<td class="text-center align-middle">' + no + '</td>' +
                                    '<td class="text-center align-middle">' + item.nama_produk + '</td>' +
                                    '<td class="text-center align-middle">' + item.harga + '</td>' +
                                    '<td class="text-center align-middle">' + item.stok + '</td>' +
                                    '<td class="text-center align-middle">' + '<img src="<?= base_url() ?>uploads/' + item.gambar + '" alt="" width=50px>' + '</td>' +
                                    '<td class="text-center align-middle">' +
                                    '<button class="btn btn-warning btn-sm editProduk" data-id="' + item.produk_id + '" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fa-solid fa-pencil"></i> Edit</button>' +
                                    '<button class="btn btn-danger btn-sm hapusProduk ms-2" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash"></i> Hapus</button>' +
                                    '</td>' +
                                    '</td>' + '</tr>'

                                produkTabel.append(row)
                                no++
                            })
                        } else {
                            alert(alert('Gagal mengambil data'))
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                })
            }

            tampil()
            $('#simpanProduk').on('click', function() {
                var formData = new FormData();
                formData.append('nama_produk', $('#NamaProduk').val());
                formData.append('harga', $('#HargaProduk').val());
                formData.append('stok', $('#StokProduk').val());
                formData.append('gambar', $('#GambarProduk')[0].files[0]);
                Swal.fire({
                    title: "Tambahkan data?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {
                    $.ajax({
                        url: '<?= base_url('produk/tambah') ?>',
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(hasil) {
                            console.log("gambar: " + hasil.gambar);
                            if (hasil.status === 'success') {
                                Swal.fire({
                                    title: "Data berhasil ditambahkan",
                                    icon: "success"
                                });
                                $('#modalTambah').modal('hide');
                                $('#formTambah')[0].reset()
                                tampil()
                            } else {
                                Swal.fire({
                                    title: "Gagal menambahkan data: " + JSON.stringify(hasil.errors),
                                    icon: "success"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan:' + error)
                        }

                    })
                })
            })

            $('#produkTable').on('click', '.hapusProduk', function() {
                var nomor = $(this).closest('tr').find('td:first').text()
                var id = $(this).attr('data-id')
                Swal.fire({
                    title: `Yakin hapus data nomor ${nomor}?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {

                    $.ajax({
                        url: '<?= base_url('produk/hapus') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'id': id
                        },
                        success: function(hasil) {
                            tampil()
                            Swal.fire({
                                title: hasil.message,
                                icon: 'success'
                            })
                        },
                        error: function(xhr, status, error) {
                            console.log('pessan error ' + error);

                        }

                    })
                })
            })

            $('#produkTable').on('click', '.editProduk', function() {
                document.getElementById('NamaProdukEdit').value = $(this).closest('tr').find('td:eq(1)').text()
                document.getElementById('HargaProdukEdit').value = $(this).closest('tr').find('td:eq(2)').text()
                document.getElementById('StokProdukEdit').value = $(this).closest('tr').find('td:eq(3)').text()
                var id = $(this).attr('data-id')
                $('#EditProduk').off('click').on('click', function() {
                    var formData = new FormData();
                    formData.append('produk_id', id)
                    formData.append('nama_produk', $('#NamaProdukEdit').val())
                    formData.append('harga', $('#HargaProdukEdit').val())
                    formData.append('stok', $('#StokProdukEdit').val())
                    if ($('#GambarProdukEdit')[0].files[0]) {
                        formData.append('gambar', $('#GambarProdukEdit')[0].files[0])
                    }


                    Swal.fire({
                        title: `Simpan perubahan?`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya"
                    }).then((result) => {
                        $.ajax({
                            url: '<?= base_url('produk/edit') ?>',
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            data: formData,
                            success: function(hasil) {
                                Swal.fire({
                                    title:hasil.message,
                                    icon:"success"
                                })
                                $('#modalEdit').modal('hide')
                                tampil()
                                

                            },
                            error: function(xhr, status, error) {
                                console.log('Error: ' + error);
                            }
                        })
                    })
                })
            })

        })
    </script>
</body>

</html>