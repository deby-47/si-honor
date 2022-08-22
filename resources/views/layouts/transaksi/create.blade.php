@extends('layouts.pegawai.app')
<html>
<title>Tambah Transaksi</title>
<style>
    .box-form {
        height: 600px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sidenav navbar navbar-verticaL fixed-left navbar-expand-xs navbar-light" id="sidenav-main">
        <div class="scrollbar-inner">
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pegawai">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Daftar Pegawai</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/trx">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Daftar Honorarium</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                </div>
            </div>
        </div>
    </nav>
    <div class="mt-3" style="position:fixed; left: 820px;">
        <h2 class="mb-0">Tambah Transaksi</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7 box-form">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    <form method="POST" class="box-form">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <label for="pegawai">Pegawai</label>
                        <div class="form-group">
                            <select class="custom-select" name="pegawai" id="pegawai" style="width:100%" required>
                                <option selected>Pilih Pegawai</option>
                                @foreach (App\Models\Pegawai::selectPegawai()->sortBy('nama') as $pg)
                                <option value="{{ $pg->id }}">{{ $pg->nama . " - " . $pg->nip . " - " . $pg->title . " - " . $pg->instansi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Sisa Kuota Penerimaan Honorarium</label>
                            <input id="kuota" type="text" class="form-control" name="kuota" disabled>
                        </div>
                        <label for="tim">Jabatan dalam Tim</label>
                        <div class="form-group">
                            <select class="custom-select" name="tim" id="tim" style="width:100%" required>
                                <option selected>Pilih Jabatan</option>
                                @foreach (App\Models\JabatanTim::selectJbt()->sortBy('id_tim') as $j)
                                <option value="{{ $j->id_tim }}">{{ $j->jbt_tim }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_sk">No SK</label>
                            <input id="no_sk" type="text" class="form-control" name="no_sk" placeholder="No SK" required>
                        </div>
                        <div class="form-group">
                            <label for="no_spm">No SPM</label>
                            <input id="no_spm" type="text" class="form-control" name="no_spm" placeholder="No SPM">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Kegiatan</label>
                            <input id="deskripsi" type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input id="keterangan" type="text" class="form-control" name="keterangan" placeholder="Keterangan">
                        </div>
                        <div class="form-group">
                            <label for="bulan">Jumlah Bulan Kegiatan</label>
                            <input id="bulan" type="text" class="form-control" name="bulan" placeholder="Jumlah Bulan">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_kotor">Jumlah Kotor</label>
                            <input id="jumlah_kotor" type="text" class="form-control" name="jumlah_kotor" placeholder="Jumlah Kotor" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penerimaan">Tanggal SPM</label>
                            <input id="tanggal_penerimaan" type="date" class="form-control" name="tanggal_penerimaan" required>
                        </div>

                        <button id="save" type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#pegawai').select2();
        $('#tim').select2();
        $('#pegawai').on('change', function() {
            var pegawaiID = $(this).val();
            if (pegawaiID) {
                $.ajax({
                    url: '/trx/kuota/' + pegawaiID,
                    dataType: 'JSON',
                    type: "GET",
                    data: {
                        "id": pegawaiID
                    },
                    success: function(response) {
                        document.getElementById('kuota').value = response;
                    }
                });
            }
        });
    </script>
</body>

</html>