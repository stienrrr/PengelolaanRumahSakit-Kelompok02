<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | {{ env('APP_NAME', 'Laravel') }}</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('dashboard/assets/images/favicon-32x32.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('dashboard/assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('dashboard/assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('dashboard/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/plugins/metismenu/mm-vertical.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('dashboard/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/sass/responsive.css') }}" rel="stylesheet">

</head>

<body>

    <div class="mx-3 mx-lg-0">
        @yield('content')
    </div>

    <!--plugins-->
    <script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>

    @include('sweetalert::alert')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });
    </script>

</body>

</html>
