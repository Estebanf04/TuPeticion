@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card encabezado"><div class="card-header">{{ __('Mis peticiones')}}</div></div>
            <div class="card elposta">
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="contenidopeticionespendientes">
                        @if($peticiones->isEmpty())  
                            <div class="peticionespendientesvacio"><p>No hay peticiones registradas</p></div>  <!-- Mensaje que se muestra en caso que no haya peticiones antiguas -->
                        @else
                        <ul>
                            @foreach($peticiones as $peticion)  <!--Recorrido de foreach pintando las peticiones antiguas -->
                                <div class="registro">
                                    <li>
                                        <div class="adad">
                                        <div class="employeename">{{$peticion->user->name.' '.$peticion->user->surname}}</div> <!--Nombre y apellido de usuario que ha realizado la peticion -->
                            
                                        <div class="resolucion">
                                            @if($peticion->status == 'aceptada')
                                                <p style="color:rgb(0, 165, 0); font-weight:bold">Aceptada</p>
                                            @elseif($peticion->status == 'denegada')
                                                <p style="color:red; font-weight:bold">Denegada</p>
                                            @elseif($peticion->status == 'pendiente')
                                                <p style="color:rgb(0, 153, 255); font-weight:bold">Pendiente</p>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="button-verpeticion"> <!-- Boton que te envia a seccion para ver los datos de la petición -->
                                            <button class="btn btn-primary seespecificrequest" onclick="location.href='{{route('seeMyRequest', ['id' => $peticion->id])}}'">
                                                Ver petición
                                            </button>
                                        </div> 
                                    </li>
                                </div>
                            @endforeach
                        </ul>  
                        @endif
                     </div>
                     <div class="clearfix">
                        {{$peticiones->links()}}  <!-- Paginación de peticiones pendientes (5 por pagina) -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
