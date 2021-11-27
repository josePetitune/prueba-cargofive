@extends('Layout.Master')

<title>PruebaCargoFive - @yield('title')</title>

@section('body')
    <section>
        @include('Layout.Header')    
    </section>
    <section>
        @yield('content')
    </section>
    @include('Layout.Footer')
@endsection

@section('scripts-js')
    @yield('js')
@endsection