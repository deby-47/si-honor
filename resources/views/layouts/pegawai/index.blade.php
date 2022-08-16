<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Daftar Pegawai</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="/docs/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
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
            <!-- <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">
                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
              </a>
            </li> -->
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
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">Admin</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                  <div class="dropdown-divider"></div>
                  <a href="#!" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <span>Logout</span>
                  </a>
              </div>
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
              <a href="/pegawai/tambah" class="btn btn-sm btn-neutral">Tambah Pegawai</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--5">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Daftar Pegawai</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <form action="/pegawai/search" method="GET">
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
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="no" style="text-align:center;font-size:12px;">No</th>
                    <th scope="col" class="sort" data-sort="nip" style="text-align:center;font-size:12px;">NIP</th>
                    <th scope="col" class="sort" data-sort="nama" style="text-align:center;font-size:12px;">Nama</th>
                    <th scope="col" class="sort" data-sort="golongan" style="text-align:center;font-size:12px;">Golongan</th>
                    <th scope="col" class="sort" data-sort="title" style="text-align:center;font-size:12px;">Jabatan</th>
                    <th scope="col" class="sort" data-sort="instansi" style="text-align:center;font-size:12px;">Instansi</th>
                    <th scope="col" class="sort" data-sort="jabatan" style="text-align:center;font-size:12px;">Eselon</th>
                    <th scope="col" class="sort" data-sort="kuota" style="text-align:center;font-size:12px;">Kuota Honorarium</th>
                    <th scope="col" class="sort" style="text-align:center;font-size:12px;">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($pg as $key => $pgs)
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ ($pg->currentpage()-1) * $pg->perpage() + $key + 1 }}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      <div class="d-flex align-items-center">
                        @php $nip = strlen($pgs->nip) < 5 ? "-" : $pgs->nip @endphp
                          <span class="completion mr-2" style="text-align:center">
                            <strong>
                              {{ $nip }}
                            </strong>
                          </span>
                      </div>
                    </td>
                    <td class="nama" style="text-align:center">
                      <strong>
                        {{ $pgs->nama }}
                      </strong>
                    </td>
                    <td class="golongan" style="text-align:center">
                      <strong>
                        {{ $pgs->golongan }}
                      </strong>
                    </td>
                    <td class="title" style="text-align:center">
                      <strong>
                        {{ $pgs->title }}
                      </strong>
                    </td>
                    <td class="instansi" style="text-align:center">
                      <strong>
                        {{ $pgs->instansi }}
                      </strong>
                    </td>
                    <td class="jabatan">
                      @php $kode = str_contains($pgs->kode, "Pejabat") || str_contains($pgs->kode, "Gubernur") ? "Non-Eselon" : $pgs->kode @endphp
                      <strong>
                        {{ $kode }}
                      </strong>
                    </td>
                    <td class="jabatan" style="text-align:center">
                      @php $kuota = $pgs->max_kuota > 5 ? "-" : $pgs->max_kuota @endphp
                      <strong>
                        {{ $kuota }}
                      </strong>
                    </td>
                    <td>
                      <a class="btn btn-xs btn-info fa fa-download" href="/export/{{ $pgs->id }}" target="_blank"></a>
                      <a class="btn btn-xs btn-primary fa fa-pen" href="/pegawai/{{ $pgs->id }}/edit"></a>
                      <form method="POST" action="{{ route('hapus', $pgs->id) }}">
                        @csrf
                        <input type="hidden" name="destroy" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger show_confirm">
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
                  <h3 class="mb-0">{{ $pg->withQueryString()->links() }}</h3>
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