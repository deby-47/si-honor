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

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../resources/views/layouts/logo/bkad.png">
        </a>
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
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
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
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tables</li>
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
              <table class="table align-items-center table-flush" counter-increment: 1>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="no">No</th>
                    <th scope="col" class="sort" data-sort="pegawai">NIP</th>
                    <th scope="col" class="sort" data-sort="pegawai">Pegawai</th>
                    <th scope="col" class="sort" data-sort="pegawai">Instansi</th>
                    <th scope="col" class="sort" data-sort="jabatan">Jabatan</th>
                    <th scope="col" class="sort" data-sort="tanggal">Tanggal SP2D</th>
                    <th scope="col" class="sort" data-sort="sk">No SK</th>
                    <th scope="col" class="sort" data-sort="spm">No SPM</th>
                    <th scope="col" class="sort" data-sort="deskripsi">Deskripsi Kegiatan</th>
                    <th scope="col" class="sort" data-sort="deskripsi">Keterangan</th>
                    <th scope="col" class="sort" data-sort="jumlah">Jumlah</th>
                    <th scope="col" class="sort" data-sort="kuota">Kuota Honorarium</th>
                    <th scope="col" class="sort">Action</th>
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
                          <span class="name mb-0 text-sm">{{ $t->nip }}</span>
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
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->instansi }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->kode }}</span>
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
                          @php $jumlah = "Rp" . number_format($t->jumlah, 2, ',','.'); @endphp
                          <span class="name mb-0 text-sm">{{ $jumlah }}</span>
                        </div>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $t->kuota }}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      <a class="btn btn-xs btn-info fa fa-download" href="/export/{{ $t->id_pegawai }}" target="_blank"></a>
                      <a class="btn btn-xs btn-primary fa fa-pencil" href="/trx/{{ $t->id_trx }}/edit"></a>
                      <form method="POST" action="{{ route('trx_hapus', $t->id_trx) }}">
                        @csrf
                        <input type="hidden" name="destroy" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger show_confirm" data-toggle="tooltip">
                          <i data-feather="delete" class="fa fa-trash"></i>
                        </button>
                      </form>
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