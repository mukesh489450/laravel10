<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>


    @vite(['resources/sass/app.scss','public/admin/dist/css/adminlte.min.css','public/admin/plugins/fontawesome-free/css/all.min.css', 'public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 'resources/js/app.js','public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js','public/admin/dist/js/adminlte.min.js','public/admin/dist/js/demo.js' ,
    'public/admin/plugins//datatables/jquery.dataTables.min.js', 'public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', 'public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js',  'public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js', 'public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js', 'public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js', 'public/admin/plugins/jszip/jszip.min.js','public/admin/plugins/pdfmake/pdfmake.min.js',  'public/admin/plugins/datatables-buttons/js/buttons.html5.min.js', 'public/admin/plugins/datatables-buttons/js/buttons.print.min.js', 'public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js', 'public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css', 'public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css', 'public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',   'public/admin/plugins/select2/css/select2.min.css','public/admin/plugins/select2/js/select2.full.min.js',
    
    ])

</head>

    
    
<body class="hold-transition sidebar-mini">
  
    <div class="wrapper">
        @include('includes.header')
        @include('includes.sidebar')
        @yield('content')

        @include('includes.scripts')
    </div>
</body>
</html>
