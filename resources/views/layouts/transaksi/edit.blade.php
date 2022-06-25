@extends('layouts.pegawai.app')
<title>Ubah Transaksi</title>

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
                            <a class="nav-link" href="/api/pegawai">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Daftar Pegawai</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/api/trx">
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
        <h2 class="mb-0">Ubah Transaksi</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    @foreach ($trx as $t)
                    <form method="POST">
                        <div class="form-group">
                            <label for="pegawai">Pegawai</label>
                            <input value="{{ $t->nama }}" id="pegawai" type="text" class="form-control" name="pegawai" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input value="{{ $t->kode }}" id="jabatan" type="text" class="form-control" name="jabatan" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="no_sk">No SK</label>
                            <input value="{{ $t->no_sk }}" id="no_sk" type="text" class="form-control" name="no_sk" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Kegiatan</label>
                            <input value="{{ $t->deskripsi }}" id="deskripsi" type="text" class="form-control" name="deskripsi" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input value="{{ $t->jumlah }}" id="jumlah" type="text" class="form-control" name="jumlah" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penerimaan">Tanggal Penerimaan</label>
                            <input value="{{ $t->tanggal_penerimaan }}" id="tanggal_penerimaan" type="date" class="form-control" name="tanggal_penerimaan" required>
                        </div>

                        <button id="save" type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>