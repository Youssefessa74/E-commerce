<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'Home')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet"
        href="{{ asset('backend/assets') }}/modules/owlcarousel2/dist/{{ asset('backend/assets') }}/owl.carousel.min.css">
    <link rel="stylesheet"
        href="{{ asset('backend/assets') }}/modules/owlcarousel2/dist/{{ asset('backend/assets') }}/owl.theme.default.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/components.css">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css ') }}">
    <!-- DataTables CSS -->
    {{-- Layout  --}}
    @if ($settings->layout == 'RTL')
        <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/rtl.css">
    @endif
    {{-- Layout  --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <script>
        const USER = {
            id: "{{ auth()->user()->id }}",
            name: "{{ auth()->user()->name }}",
            image: "{{ auth()->user()->image }}"
        }
        const PUSHER = {
            key: "{{ $pusherSettings->key }}",
            cluster: "{{ $pusherSettings->cluster }}",
        };
    </script>
    @vite(['resources/js/app.js'])

    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('admin.layout.header_sidebar')
            <!-- Main Content -->
            @yield('content')
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('backend/assets') }}/modules/jquery.min.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/popper.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/tooltip.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/moment.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('backend/assets') }}/modules/jquery.sparkline.min.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/chart.min.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/summernote/summernote-bs4.js"></script>
    <script src="{{ asset('backend/assets') }}/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="{{ asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/assets') }}/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="{{ asset('backend/assets') }}/js/scripts.js"></script>
    <script src="{{ asset('backend/assets') }}/js/custom.js"></script>
    <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('backend') }}/assets/modules/select2/dist/js/select2.full.min.js"></script>


    <script src="//cdnjs.cloudfare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- jQuery -->

    <!-- DataTables JS -->
    <script src="//cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1d0599e1e319a8c54baa', {
            cluster: 'mt1'
        });
    </script>

    @stack('scripts')
</body>

</html>
