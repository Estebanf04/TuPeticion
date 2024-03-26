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
                        <p> <strong>Empleado:</strong>  {{$peticionespecifica->user->name.' '.$peticionespecifica->user->surname}} </p>
                        <p> <strong>Fecha deseada:</strong>  {{$peticionespecifica->date}} </p>
                        <p> <strong>Mensaje:</strong>  {{$peticionespecifica->content}} </p>
                    </div>
                </div>
            </div>

            @if($peticionespecifica->status == 'pendiente')
            <!--Intentar crear SweetAlerts para aceptar o denegar la petición -->
                <div class="decision">
                    <button class="btn btn-success yesrequest" data-bs-toggle="modal" data-bs-target="#aceptar">
                         Aceptar 
                    </button>
                    @include('components.modalaceptarpeticion')

                    <button class="btn btn-danger notrequest" data-bs-toggle="modal" data-bs-target="#denegar">
                         Denegar 
                    </button>

                    @include('components.modaldenegarpeticion')
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

