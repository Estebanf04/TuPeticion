@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="contenedoropciones">
                <div class="card opcion" style="cursor: pointer" onclick="location.href='{{route('showRequest')}}'">
                    <div class="card-body">
                        <h3>Peticiones pendientes</h3>
                    </div>
                </div>
                <br>
                <div class="card opcion" style="cursor: pointer" onclick="location.href='{{route('showEmployees')}}'">
                    <div class="card-body">
                        <h3>Listado de empleados</h3>
                    </div>
                </div>
                <br>
                <div class="card opcion" style="cursor: pointer" onclick="location.href='{{route('showRequestHistory')}}'">
                    <div class="card-body">
                        <h3>Historial de peticiones</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
