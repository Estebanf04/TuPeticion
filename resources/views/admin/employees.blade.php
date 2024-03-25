@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(Session::has('message'))
            <script>
                swal("¡Perfecto!", "{{ Session::get('message') }}", 'success',{
                    button:true,
                    button:"OK",
                })
            </script>
            @endif
            
            <div class="card encabezado"><div class="card-header">{{ __('Listado de empleados')}}</div></div>
            <div class="card elposta">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button class="btn btn-success yesrequest" onclick="location.href='{{route('createEmployee')}}'">Nuevo empleado</button>

                    <div class="contenidopeticionespendientes enempleados">
                        @if($empleados -> isEmpty())  
                            <div class="peticionespendientesvacio"><p>No hay empleados registrados</p></div>  <!-- Mensaje que se muestra en caso que no haya empleados registrados -->
                        @else
                        <ul>
                            @foreach($empleados as $empleado)  <!--Recorrido de foreach pintando empleados -->
                                <div class="registro reg-empleado">
                                    <li>
                                        <div class="employeename">{{$empleado->name.' '.$empleado->surname}}</div> <!--Nombre y apellido del empleado -->
                                        
                                        <div class="buttons-actions"> <!-- Botones para editar o borrar -->
                                            <button class="btn btn-primary editemployee" onclick="location.href='{{route('editEmployee', ['id' => $empleado->id])}}'">
                                            <i class='bx bx-pencil'></i>
                                            </button>

                                            <button class="btn btn-danger deletemployee" onclick="location.href='{{route('deleteEmployee', ['id' => $empleado->id])}}'" >
                                                
                                                <i class='bx bx-trash'></i>
                                                
                                            </button>
                                        </div> 

                                    
                                        
                                    </li>
                                    
                                </div>
                            @endforeach
                            
                        </ul>  
                        @endif

                     </div>

                     <div class="clearfix">
                        <div class="paginacion">{{$empleados->links()}}</div>  <!-- Paginación de empleados (10 por pagina) -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




