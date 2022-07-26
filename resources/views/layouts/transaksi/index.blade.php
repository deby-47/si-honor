<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Daftar Honorarium</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<style>
  .container {
    width: 105px;
    height: 140px;
    margin-top: 20px;
    background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Coat_of_arms_of_North_Kalimantan_%282021_version%29.svg/1200px-Coat_of_arms_of_North_Kalimantan_%282021_version%29.svg.png");
    background-size: cover;
    background-repeat: no-repeat;
  }

  .topcorner {
    position: absolute;
    top: 70px;
    right: 5px;
  }
</style>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="container">

      </div>
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
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="/trx/tambah" class="btn btn-sm btn-neutral">Tambah Transaksi</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Daftar Honorarium</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <form action="/trx/search" method="GET">
                <div class="col-auto mb-3">
                  <div class="input-group-prepend">
                    <span>
                      <div class="col-auto">
                        <input type="text" name="search" class="form-control" id="search" placeholder="Search..." value="{{ old('search') }}">
                      </div>
                    </span>
                    <button id="search" type="submit" class="btn btn-primary">Cari</button>
                  </div>
                </div>
              </form>
              <div class="topcorner">
                <a class="btn btn-info fa fa-file-pdf" target="_blank" href="/signee"></a>
              </div>
              <table class="table align-items-center table-flush" counter-increment: 1>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="no" style="text-align:center;font-size:12px;">No</th>
                    <th scope="col" class="sort" data-sort="nip" style="text-align:center;font-size:12px;">NIP</th>
                    <th scope="col" class="sort" data-sort="pegawai" style="text-align:center;font-size:12px;">Pegawai</th>
                    <th scope="col" class="sort" data-sort="title" style="text-align:center;font-size:12px;">Jabatan</th>
                    <th scope="col" class="sort" data-sort="tim" style="text-align:center;font-size:12px;">Jabatan dalam Tim</th>
                    <th scope="col" class="sort" data-sort="tanggal" style="text-align:center;font-size:12px;">Tanggal SPM</th>
                    <th scope="col" class="sort" data-sort="sk" style="text-align:center;font-size:12px;">No SK</th>
                    <th scope="col" class="sort" data-sort="spm" style="text-align:center;font-size:12px;">No SPM</th>
                    <th scope="col" class="sort" data-sort="deskripsi" style="text-align:center;font-size:12px;">Deskripsi Kegiatan</th>
                    <th scope="col" class="sort" data-sort="keterangan" style="text-align:center;font-size:12px;">Keterangan</th>
                    <th scope="col" class="sort" data-sort="bulan" style="text-align:center;font-size:12px;">Jumlah Bulan</th>
                    <th scope="col" class="sort" data-sort="jumlah" style="text-align:center;font-size:12px;">Jumlah</th>
                    <th scope="col" class="sort" data-sort="pph" style="text-align:center;font-size:12px;">PPh</th>
                    <th scope="col" class="sort" data-sort="diterima" style="text-align:center;font-size:12px;">Diterima</th>
                    <th scope="col" class="sort" data-sort="kuota" style="text-align:center;font-size:12px;">Kuota Honorarium</th>
                    <th scope="col" class="sort" style="text-align:center">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($trx as $key => $t)
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ ($trx->currentpage()-1) * $trx->perpage() + $key + 1 }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                        @php $nip = strlen($t->nip) < 5 ? "-" : $t->nip @endphp
                          <span class="name mb-0 text-sm">{{ $nip }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->nama }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row" style="text-align:center">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->title }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->jbt_tim }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ Carbon\Carbon::parse($t->tanggal_penerimaan)->translatedFormat('d F Y') }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->no_sk }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->no_spm }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->deskripsi }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->keterangan }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->bulan }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          @php $jumlah = "Rp" . number_format($t->jumlah_kotor, 2, ',','.'); @endphp
                          <span class="name mb-0 text-sm">{{ $jumlah }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          @php $jumlah = "Rp" . number_format(($t->jumlah_kotor - $t->jumlah), 2, ',','.'); @endphp
                          <span class="name mb-0 text-sm">{{ $jumlah }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          @php $jumlah = "Rp" . number_format($t->jumlah, 2, ',','.'); @endphp
                          <span class="name mb-0 text-sm">{{ $jumlah }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row" style="text-align:center">
                      <div class="media align-items-center">
                        <div class="media-body">
                          @php $kuota = $t->kuota > 5 ? "-" : $t->kuota @endphp
                          <span class="name mb-0 text-sm">{{ $kuota }}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      <a class="btn btn-xs btn-primary fa fa-pencil" href="/trx/{{ $t->id_trx }}/edit"></a>
                      <!-- <form method="POST" action="{{ route('trx_hapus', $t->id_trx) }}">
                        @csrf
                        <input type="hidden" name="destroy" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger show_confirm" data-toggle="tooltip">
                          <i data-feather="delete" class="fa fa-trash"></i>
                        </button>
                      </form> -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <h3 class="mb-0">
                    {{ $trx->withQueryString()->links() }}
                  </h3>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; {{ now()->year }}
            </div>
          </div>
        </div>
      </footer>
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
  <script type="text/javascript">
    $('.show_confirm').click(function(event) {
      var form = $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to delete this record?`,
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });
  </script>
</body>

</html>