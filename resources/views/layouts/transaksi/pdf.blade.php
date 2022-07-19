<!DOCTYPE html>
<html>

<style>
    .container {
        width: 60px;
        height: 80px;
        margin-left: auto;
        margin-right: auto;
        background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Coat_of_arms_of_North_Kalimantan_%282021_version%29.svg/1200px-Coat_of_arms_of_North_Kalimantan_%282021_version%29.svg.png");
        background-size: cover;
        background-repeat: no-repeat;
    }

    .border {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body>
    <div class="container">

    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0" style="text-align:center;vertical-align:middle">Daftar Penerima <br> {{ reset($trx)->deskripsi }}</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush border" counter-increment: 1>
                            <thead class="thead-light border">
                                <tr class="border">
                                    <th scope="col" class="sort" data-sort="no" style="text-align:center;font-size:12px;">No</th>
                                    <th scope="col" class="sort" data-sort="nip" style="text-align:center;font-size:12px;">NIP</th>
                                    <th scope="col" class="sort" data-sort="pegawai" style="text-align:center;font-size:12px;">Pegawai</th>
                                    <th scope="col" class="sort" data-sort="instansi" style="text-align:center;font-size:12px;">Instansi</th>
                                    <th scope="col" class="sort" data-sort="jabatan" style="text-align:center;font-size:12px;">Jabatan dalam Tim</th>
                                    <th scope="col" class="sort" data-sort="sk" style="text-align:center;font-size:12px;">No SK</th>
                                    <th scope="col" class="sort" data-sort="deskripsi" style="text-align:center;font-size:12px;">Deskripsi Kegiatan</th>
                                    <th scope="col" class="sort" data-sort="keterangan" style="text-align:center;font-size:12px;">Keterangan</th>
                                    <th scope="col" class="sort" data-sort="bulan" style="text-align:center;font-size:12px;">Jumlah Bulan</th>
                                    <th scope="col" class="sort" data-sort="jumlah" style="text-align:center;font-size:12px;">Jumlah</th>
                                    <th scope="col" class="sort" data-sort="pph" style="text-align:center;font-size:12px;">PPh</th>
                                    <th scope="col" class="sort" data-sort="diterima" style="text-align:center;font-size:12px;">Diterima</th>
                                    <th scope="col" class="sort" data-sort="kuota" style="text-align:center;font-size:12px;">Kuota Honorarium</th>
                                </tr>
                            </thead>
                            <tbody class="list border">
                                @foreach ($trx as $key => $t)
                                <tr class="border">
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $key + 1 }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->nip }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->nama }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->instansi }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" style="text-align:center" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->jbt_tim }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->no_sk }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->deskripsi }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->keterangan }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" style="text-align:center" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->bulan }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" style="text-align:center" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->jumlah_kotor }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" style="text-align:center" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                @php $jumlah = "Rp" . number_format((15 * $t->jumlah_kotor / 100), 2, ',','.'); @endphp
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $jumlah }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                @php $jumlah = "Rp" . number_format($t->jumlah, 2, ',','.'); @endphp
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $jumlah }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row" style="text-align:center" class="border">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm" style="font-size:12px;">{{ $t->kuota }}</span>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table align-items-center table-flush" align="right">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="pa" style="padding: 45px;">
                                        Pengguna Anggaran
                                    </th>
                                    <th scope="col" class="sort" data-sort="pptk" style="padding: 45px;">
                                        Pejabat Pelaksana Teknis Kegiatan
                                    </th>
                                    <th scope="col" class="sort" data-sort="bendahara" style="padding: 45px;">
                                        Bendahara Pengeluaran
                                    </th>
                                </tr>
                            </thead>
                            @php $pa = DB::table('pegawai')->where('id', '=', Illuminate\Support\Facades\Session::get('pa'))->first()->nama @endphp
                            @php $pa_nip = DB::table('pegawai')->where('id', '=', Illuminate\Support\Facades\Session::get('pa'))->first()->nip @endphp
                            @php $pptk = DB::table('pegawai')->where('id', '=', Illuminate\Support\Facades\Session::get('pptk'))->first()->nama @endphp
                            @php $pptk_nip = DB::table('pegawai')->where('id', '=', Illuminate\Support\Facades\Session::get('pptk'))->first()->nip @endphp
                            @php $bendahara = DB::table('pegawai')->where('id', '=', Illuminate\Support\Facades\Session::get('bendahara'))->first()->nama @endphp
                            @php $bendahara_nip = DB::table('pegawai')->where('id', '=', Illuminate\Support\Facades\Session::get('bendahara'))->first()->nip @endphp
                            <tbody class="list">
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm"><br><br><br><br>
                                                    {{ $pa }}<br>NIP: {{ $pa_nip }}
                                                </span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm"><br><br><br><br>
                                                    {{ $pptk }}<br>NIP: {{ $pptk_nip }}
                                                </span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm"><br><br><br><br>
                                                    {{ $bendahara }}<br>NIP: {{ $bendahara_nip }}
                                                </span>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.2.0"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
</body>

</html>