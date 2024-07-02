<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ url('public/admin/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ url('public/admin/js/all.js') }}"></script>
    <script src="{{ url('public/admin/js/jquery.min.js') }}"></script>
    <script src="{{ url('public/admin/js/sweetalert.min.js') }}"></script>
    {{-- <link rel="stylesheet" href="{{url('public/admin/assets/datatables-bs4/css/dataTables.bootstrap4.min.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{url('public/admin/assets/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{url('public/admin/assets/datatables-buttons/css/buttons.bootstrap4.min.css')}}"> --}}
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('public/admin/assets/summernote/summernote-lite.min.css') }}">


</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item">{{ $_SESSION['user_name'] }}</a></li>
                    {{-- <li><a class="dropdown-item" href="#!">Activity Log</a></li> --}}
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                        <a class="nav-link" href="{{ route('Dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link" href="{{ route('Blog') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                            Blog
                        </a>
                        <a class="nav-link" href="{{ route('Gallery') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                            Gallery
                        </a>



                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ $_SESSION['user_name'] }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            @yield('content')

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ url('public/admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('public/admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('public/admin/assets/summernote/summernote-lite.min.js') }}"></script>

</body>

</html>
