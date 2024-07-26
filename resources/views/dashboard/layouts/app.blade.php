<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Bootstrap 5 css -->
    <link rel="stylesheet" href="{{ asset('assets/other_assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome Css -->
    <link rel="stylesheet" href="{{ asset('assets/other_assets/css/all.min.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- ckeditor -->
    <script src="https://cdn.jsdelivr.net/npm/ckeditor5@42.0.2/dist/browser/ckeditor5.min.js"></script>
    <!-- Map Picker leaflet.css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <!-- Map Picker from dist -->
    <link rel="stylesheet" href="{{ asset('dist/leaflet-locationpicker.src.css') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('items.index') }}"><img src="{{ asset('assets/images/logo-mini.svg') }}"
                        alt="logo" />Admin Panel</a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('items.index') }}"><img
                        src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas d-flex flex-column justify-content-between" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{ asset('default_images/profile.png') }}" alt="profile">
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('items.index') }}">
                            <i class="fa-solid fa-table-cells-large"></i>
                            <span class="menu-title ms-2">Item</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            <i class="fa-solid fa-list"></i>
                            <span class="menu-title ms-2">Category</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" id="myForm">
                            @csrf
                            <a href="#" onclick="return confirmSubmit();" class="nav-link">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="menu-title ms-2">Logout</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- sidebar.html End -->
            @yield('content')
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
        <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('assets/js/misc.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <script src="{{ asset('assets/js/todolist.js') }}"></script>
        <!-- Bootstrap 5 js -->
        <script src="{{ asset('assets/other_assets/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Fontawesome js -->
        <script src="{{ asset('assets/other_assets/js/all.min.js') }}"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <!-- Jquery Js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <!-- End custom js for this page -->
        <!-- Map Picker leaflet.js -->
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <!-- Map Picker from dist -->
        <script src="{{ asset('dist/leaflet-locationpicker.min.js') }}"></script>
        <!-- Custom Script -->
        <script>
            function confirmSubmit() {
                let result = window.confirm("Are you sure you want to logout?");
                if (result) {
                    document.querySelector('#myForm').submit();
                }
                return result;
            }
        </script>
</body>

@yield('script')

</html>
