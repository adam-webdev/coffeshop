<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/jpg" sizes="16x16" href="/favicon.jpg">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title', 'Beranda')</title>
    <link href="{{ asset('asset/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    {{-- swal --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script> --}}




    <!-- End Mapbox -->
    @yield('css')
    <style>
        a.nav-link span,
        a.nav-link i {
            font-weight: 700;
            color: black;

        }

        ul li a.active {
            background: rgb(232, 232, 242);
            border-radius: 8px;

        }

        a.nav-link:hover {
            background: rgb(232, 232, 242);
            border-radius: 8px;
        }

        .paginate_button .page-item .active {
            background-color: #663300 !important;
            color: white;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #663300;
        }

        @media screen and (max-width:450px) {

            body {
                font-size: 12px;
            }

            #searchDropdown {
                display: none;
            }

            .sidebar {
                left: -200px;
            }
        }
    </style>
</head>

<body id="page-top">
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav fixed-left sidebar accordion" id="accordionSidebar"
            style="background: hsl(0, 0%, 100%); color:#663300;">

            <div>

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand text-dark font-weight-bold d-flex align-items-center justify-content-center"
                    href="/" style="margin-top:20px">
                    <div class="sidebar-brand-icon ">
                        <img src="{{ asset('asset/img/coffe.jpg') }}" width="120">
                        {{-- <i class="fa fa-home"></i> --}}
                    </div>

                </a>
                <p class="ml-3 mt-4 text-center"><b> Katanya </b></p>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <i class="fa fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

             <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('hitung/eoq') ? 'active' : '' }}"
                    href="{{ route('hitung_eoq') }}">
                    <i class="fas fa-square-root-alt"></i>
                    <span>EOQ</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages1">
                    <i class="fas fa-folder"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('menu.index') }}">
                            Daftar Menu </a>
                        <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('kategori.index') }}">
                            Kategori </a>
                        <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('meja.index') }}">
                            Meja </a>

                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages1">
                    <i class="fas fa-utensils"></i>
                    <span>Dapur</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('bahan-baku.index') }}">
                            Stok Bahan Baku </a>
                        <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('bahanbaku-masuk.index') }}">
                            Bahan Baku Masuk </a>
                        <a class="collapse-item fas fa-arrow-circle-right"
                            href="{{ route('bahanbaku-terpakai.index') }}">
                            Bahan Baku Terpakai </a>
                        <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('ingredients.index') }}">
                            Bahan Bahan Menu </a>
                        <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('orderbahanbaku.index') }}">
                            Order Bahan Bahan Baku </a>
                    </div>
                </div>
            </li>

            {{-- @role('Admin') --}}

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('user') ? 'active' : '' }}"
                    href="{{ route('user.index') }}">
                    <i class="fas fa-user-alt "></i>
                    <span>User</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('order') ? 'active' : '' }}"
                    href="{{ route('order.index') }}">
                    <i class="fas fa-cash-register"></i>
                    <span>Kasir</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('riwayat-order') ? 'active' : '' }}"
                    href="{{ route('order.riwayat') }}">
                    <i class="fas fa-history"></i>
                    <span>Data Order</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('pembayaran') ? 'active' : '' }}"
                    href="{{ route('pembayaran.index') }}">
                    <i class="fas fa-money-check-alt"></i>
                    <span>Transaksi</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            {{-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> --}}

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand  topbar bg-white static-top shadow"
                    style="margin:10px 20px;border-radius:8px;background-color:rgb(255, 255, 255)!important;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-linkrounded-circle mr-3">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="input-group-append">
                                <h4 class="text-dark font-weight-bold">Coffeshop Katanya </h4>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - 2`3 Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="425"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('/asset/img/coffe.jpg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('user.show', [Auth::user()->id]) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid mb-4">

                    <!-- DataTales Example -->
                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Dibuat oleh Adam Webdev<br> &copy; Coffeshop Katanya, Indonesia. </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar aplikasi ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" apabila ingin keluar aplikasi</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('asset/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('asset/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('asset/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('asset/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('asset/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('asset/vendor/select2/dist/js/select2.min.js') }}"></script>



    @yield('scripts')

</body>

</html>
