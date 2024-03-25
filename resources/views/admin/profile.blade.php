@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('message'))
            <script>
                swal("¡Genial!", "{{ Session::get('message') }}", 'success',{
                    button:true,
                    button:"OK",
                })
            </script>
            @endif
            <div class="card encabezado"><div class="card-header">{{ __('Mi perfil')}}</div></div>

            <div class="card elposta">

                <div class="usuario">
                    <div class="nombreperfil"><h2>{{Auth::user()->name.' '.Auth::user()->surname}}</h2></div>
                    @if(Auth::user()->role == 'admin')
                    <div class="role administrador"><h5>Administrador</h5></div>
                    @elseif(Auth::user()->role == 'user')
                    <div class="role empleado"><h5>Empleado</h5></div>
                    @endif

                </div>
                <div class="card-body">
                    <div class="campoemail">
                        <h5><strong style="color:white">Email de acceso:</strong> {{Auth::user()->email}} </h5>
                    </div>

                    @if(Auth::user()->role == 'user')
                        <div class="campodni">
                            <h5><strong style="color:white">DNI:</strong> {{Auth::user()->dni}} </h5>
                        </div>
                    @endif      
                    
                    <div class="botoncambiarcontraseña">
                        @if(Auth::user()->role == 'admin')
                        <button class="btn btn-primary" onclick="location.href='{{route('changePassword')}}'">
                            Cambiar clave de acceso
                        </button>
                        @elseif(Auth::user()->role == 'user')
                        <button class="btn btn-primary" onclick="location.href='{{route('changePasswordUser')}}'">
                            Cambiar clave de acceso
                        </button>
                        @endif
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
