@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card encabezado"><div class="card-header">{{ __('Datos de la petición')}}</div></div>
            <div class="card elposta">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="datos">
                        <p><strong>Empleado:</strong>  {{$peticionespecifica->user->name.' '.$peticionespecifica->user->surname}}</p>
                        <p><strong>Fecha deseada:</strong>  {{$peticionespecifica->date}}</p>
                        <p><strong>Mensaje:</strong>  {{$peticionespecifica->content}}</p>
                    </div>
                </div>
            </div>       
        </div>
    </div>
</div>

@endsection