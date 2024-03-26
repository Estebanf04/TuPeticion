@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          @if(Session::has('message'))
            <script>
                swal("Error", "{{ Session::get('message') }}", 'error',{
                    button:true,
                    button:"OK",
                    dangerMode:true,
                })
            </script>
            @endif

            <div class="card encabezado"><div class="card-header">{{ __('Cambiar contraseña')}}</div></div>

                <div class="card elposta">
                    <div class="card-body">
                        <form action=" 
                        @if(Auth::User()->role == 'admin')
                        {{route('saveChange')}}
                        @elseif(Auth::user()->role == 'user')
                        {{route('saveNewPasswordUser')}}
                        @endif
                        " method="post"> <!--Ruta de recepcion segun su rol -->
                            @csrf
                              <div class="mb-3">
                                <label for="password" class="form-label">Nueva contraseña</label>
                                <input type="password" class="form-control" name="password" require="required">
                                  @error('password')
                                    <div class="error"><p style="color:red; font-weight:bold">{{$message}}</p></div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                <label for="confirmpassword" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="confirmpassword" require="required">
                                  @error('confirmpassword')
                                    <div class="error"><p style="color:red;font-weight:bold">{{$message}}</p></div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                <input type="submit" class="btn btn-primary mb-3 crearnew" value="Aceptar" data-bs-toggle="modal" data-bs-target="#confirmar">
                              </div>
                      </div>
                </div>

          </div>
    </div>
</div>
@endsection