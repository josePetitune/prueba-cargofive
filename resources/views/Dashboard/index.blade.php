@extends('Layout.Page')

@section('title','Inicio')
@section('content')
    <div id="app" class="container-fluid">
        <div class="d-flex justify-content-center mt-3">
            <h6 aling="center">Prueba tecnica para</h6>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <img src="{{asset('storage/logo.svg')}}" style="width:150px;" alt="">
        </div>
        <div class="row">
            <div class="col-12 mb-5">
                <form-component></form-component>
            </div>
        </div>
    </div>
@endsection

@section('js')
    
@endsection