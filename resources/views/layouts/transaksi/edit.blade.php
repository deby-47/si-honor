@extends('layouts.pegawai.app')
<title>Ubah Transaksi</title>
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
        <h2 class="mb-0">Ubah Transaksi</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    @foreach ($trx as $t)
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
                        <div class="form-group">
                            <label for="pegawai">Pegawai</label>
                            <input value="{{ $t->nama }}" id="pegawai" type="text" class="form-control" name="pegawai" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input value="{{ $t->nip }}" id="nip" type="text" class="form-control" name="nip" required readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="instansi">Instansi</label>
                            <input value="{{ $t->instansi }}" id="instansi" type="text" class="form-control" name="instansi" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan dalam Tim</label><br />
                            @php $jbt = App\Models\JabatanTim::selectJbt()->sortBy('id_tim'); @endphp
                            <select class="custom-select" name="jabatan" id="jabatan" required>
                                <option selected disabled>Pilih Jabatan</option>
                                @foreach ($jbt as $j)
                                <option value="{{ $j->id_tim }}">{{ $j->jbt_tim }}</option>
                                @endforeach
                            </select>
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
                            <label for="keterangan">Keterangan</label>
                            <input value="{{ $t->keterangan }}" id="keterangan" type="text" class="form-control" name="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="bulan">Jumlah Bulan Kegiatan</label>
                            <input value="{{ $t->bulan }}" id="bulan" type="text" class="form-control" name="bulan" placeholder="Jumlah Bulan">
                        </div>
                        <div class="form-group">
                            <label for="bulan">Jumlah Kotor</label>
                            <input value="{{ $t->jumlah_kotor }}" id="jumlah_kotor" type="text" class="form-control" name="jumlah_kotor">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penerimaan">Tanggal SPM</label>
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