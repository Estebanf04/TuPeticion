@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('message'))
                <script>
                    swal("¡Hecho!", "{{ Session::get('message') }}", 'success',{
                        button:true,
                        button:"OK",
                    })
                </script>
            @endif
            <div class="card encabezado"><div class="card-header">{{ __('Peticiones pendientes')}}</div></div>


            <div class="card elposta">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="contenidopeticionespendientes">
                        @if($peticiones -> isEmpty())  
                            <div class="peticionespendientesvacio"><p>No hay peticiones pendientes</p></div>  <!-- Mensaje que se muestra en caso que no haya peticiones pendientes -->
                        @else
                        <ul>
                            @foreach($peticiones as $peticion)  <!--Recorrido de foreach pintando las peticiones pendientes -->
                                <div class="registro">
                                    <li>
                                        <div class="employeename">{{$peticion->user->name.' '.$peticion->user->surname}}</div> <!--Nombre y apellido de usuario que realizo la peticion -->
                                        
                                        <div class="button-verpeticion"> <!-- Boton que te envia a seccion para ver los datos de la petición -->
                                            <button class="btn btn-primary seespecificrequest" onclick="location.href='{{route('seeSpecificRequest', ['id' => $peticion->id])}}'">
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
