@extends('layouts.pegawai.app')
<title>Tambah Transaksi</title>

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
        <h2 class="mb-0">Tambah Transaksi</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    <form method="POST">
                        <div class="form-group">
                            <label for="id_pegawai">Pegawai</label>
                            <select class="custom-select" name="id_pegawai" required>
                                <option selected>Pilih Pegawai</option>
                                @foreach (App\Models\Pegawai::selectPegawai() as $pg)
                                <option value="{{ $pg->id }}">{{ $pg->nama }}</option>
                                @endforeach
                            </select>
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
                            <label for="no_sk">Deskripsi Kegiatan</label>
                            <input id="no_sk" type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumlah</label>
                            <input id="jumlah" type="text" class="form-control" name="jumlah" placeholder="Jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Tanggal Penerimaan</label>
                            <input id="tanggal_penerimaan" type="date" class="form-control" name="tanggal_penerimaan" required>
                        </div>

                        <button id="save" type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>