@extends('layouts.pegawai.app')
<title>Ubah Pegawai</title>

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
        <h2 class="mb-0">Ubah Pegawai</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    @foreach ($pg as $pgs)
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input value="{{ $pgs->nip }}" id="nip" type="text" class="form-control" name="nip" placeholder="NIP" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input value="{{ $pgs->nama }}" id="nama" type="text" class="form-control" name="nama" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="instansi">Instansi</label>
                            <input value="{{ $pgs->instansi }}" id="instansi" type="text" class="form-control" name="instansi">
                        </div>
                        <div class="form-group">
                            <label for="title">Jabatan</label>
                            <input value="{{ $pgs->title }}" id="title" type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="golongan">Golongan</label>
                            <input value="{{ $pgs->golongan }}" id="golongan" type="text" class="form-control" name="golongan">
                        </div>
                        <div class="form-group">
                        <label for="jabatan">Eselon</label><br/>
                            @php $jbt = App\Models\Jabatan::selectJbt(); @endphp
                            <select class="custom-select" name="jabatan" id="jabatan" required>
                                <!-- <option selected disabled>{{ $pgs->kode }}</option> -->
                                <option selected disabled>Pilih Jabatan</option>
                                @foreach ($jbt as $j)
                                <option value="{{ $j->id_jbt }}">{{ $j->kode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>