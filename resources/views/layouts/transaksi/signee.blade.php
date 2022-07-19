@extends('layouts.pegawai.app')
<title>Pejabat Penandatangan</title>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

<body>
    <div class="mt-3" style="position:fixed; left: 820px;">
        <h2 class="mb-0">Pejabat Penandatangan</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    <form method="POST">
                        <div class="form-group">
                            <label for="nip">Pengguna Anggaran</label>
                            <div class="form-group">
                                <select class="custom-select" name="pa" id="pa" style="width:100%" required>
                                    <option selected>Pilih Pegawai</option>
                                    @foreach (App\Models\Pegawai::selectPegawai()->sortBy('nama') as $pg)
                                    <option value="{{ $pg->id }}">{{ $pg->nama . " - " . $pg->nip . " - " . $pg->instansi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instansi">PPTK</label>
                            <div class="form-group">
                                <select class="custom-select" name="pptk" id="pptk" style="width:100%" required>
                                    <option selected>Pilih Pegawai</option>
                                    @foreach (App\Models\Pegawai::selectPegawai()->sortBy('nama') as $pg)
                                    <option value="{{ $pg->id }}">{{ $pg->nama . " - " . $pg->nip . " - " . $pg->instansi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Bendahara Pengeluaran</label>
                            <div class="form-group">
                                <select class="custom-select" name="bendahara" id="bendahara" style="width:100%" required>
                                    <option selected>Pilih Pegawai</option>
                                    @foreach (App\Models\Pegawai::selectPegawai()->sortBy('nama') as $pg)
                                    <option value="{{ $pg->id }}">{{ $pg->nama . " - " . $pg->nip . " - " . $pg->instansi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button id="save" type="submit" formtarget="_blank" class="btn btn-info">Export</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#pa').select2();
        $('#pptk').select2();
        $('#bendahara').select2();
    </script>
</body>