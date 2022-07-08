@extends('layouts.pegawai.app')
<html>
<title>Tambah Transaksi</title>
<style>
    .box-form {
        max-height: 600px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

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
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    <form method="POST" class="box-form">
                        <div class="form-group">
                            <label for="id_pegawai">Pegawai</label>
                            <select class="custom-select" name="id_pegawai" id="id_pegawai" required>
                                <option selected>Pilih Pegawai</option>
                                @foreach (App\Models\Pegawai::selectPegawai()->sortBy('nama') as $pg)
                                <option value="{{ $pg->id }}">{{ $pg->nama . " - " . $pg->nip . " - " . $pg->instansi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Sisa Kuota Penerimaan Honorarium</label>
                            <input id="kuota" type="text" class="form-control" name="kuota" disabled>
                        </div>
                        <!-- <div class="form-group">
                            <label for="jabatan">Jabatan</label><br />
                            <select class="custom-select" name="jabatan" required>
                                <option selected>Pilih Jabatan</option>
                                @foreach (App\Models\Jabatan::selectJbt() as $j)
                                <option value="{{ $j->id_jbt }}">{{ $j->kode }}</option>
                                @endforeach
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="no_sk">No SK</label>
                            <input id="no_sk" type="text" class="form-control" name="no_sk" placeholder="No SK" required>
                        </div>
                        <div class="form-group">
                            <label for="no_spm">No SPM</label>
                            <input id="no_spm" type="text" class="form-control" name="no_spm" placeholder="No SPM" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Kegiatan</label>
                            <input id="deskripsi" type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input id="keterangan" type="text" class="form-control" name="keterangan" placeholder="Keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input id="jumlah" type="text" class="form-control" name="jumlah" placeholder="Jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penerimaan">Tanggal SP2D</label>
                            <input id="tanggal_penerimaan" type="date" class="form-control" name="tanggal_penerimaan" required>
                        </div>

                        <button id="save" type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#id_pegawai').on('change', function() {
                var pegawaiID = $(this).val();
                console.log('view', pegawaiID);
                if (pegawaiID) {
                    $.ajax({
                        url: '/trx/kuota/' + pegawaiID,
                        dataType: 'JSON',
                        type: "GET",
                        data: {
                            "id": pegawaiID
                        },
                        success: function(response) {
                            console.log('success', response)
                            document.getElementById('kuota').value = response;
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>