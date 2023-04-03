<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- FONTAWESOME CSS -->
    <link rel="stylesheet" href="{{ asset('assets/other_assets/css/all.min.css') }}">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('assets/other_assets/css/bootstrap.min.css') }}">
    @yield('style')
</head>

<body class="fs-5">
    @yield('content')
</body>
<!-- FONTAWESOME JS -->
<script src="{{ asset('assets/other_assets/js/all.min.js') }}"></script>
<!-- BOOTSTRAP JS -->
<script src="{{ asset('assets/other_assets/js/bootstrap.bundle.min.js') }}"></script>
@yield('script')

</html>
