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
            
             <div id="contenedoropciones">
                <div class="card opcion" style="cursor: pointer" onclick="location.href='{{route('createRequest')}}'">
                    <div class="card-body">
                         <h3>Crear Petición</h3>
                    </div>
                </div>
                <br>
                <div class="card opcion" style="cursor: pointer" onclick="location.href='{{route('myRequests')}}'">
                    <div class="card-body">
                         <h3>Mis Peticiones</h3>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>
@endsection
