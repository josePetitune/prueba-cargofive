<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="description" content="Pagina de prueba de aptitud para cargofive.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('css/ionicons.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('css/all.min.css')}}">
        <!--link rel="stylesheet" href="{{-- asset('DataTables/datatables.min.css') --}}"-->
    </head>
    <body id="body">
        @yield('sidebar')
        @yield('body')
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/all.min.js')}}"></script>
        <!--script src="{{-- asset('DataTables/datatables.min.js')--}}"></!--script-->
        @yield('scripts-js')
        
    </body>
    
</html>

