@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card encabezado"><div class="card-header">{{ __('Crear petición')}}</div></div>

            <div class="card elposta">
        
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('saveRequest')}}" method="post">
                        @csrf
                          <div class="mb-3">
                            <label for="date" class="form-label">Fecha deseada</label>
                            <input type="date" class="form-control" name="date" require="required">
                            @error('date')
                              <div class="error"><p style="color:red">{{$message}}</p></div>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="floatingTextarea2">Mensaje explicativo</label>
                            <textarea class="form-control" name="content" placeholder="Escribe tu mensaje aqui.." style="min-height: 80px; max-height:130px"></textarea>
                            @error('content')
                              <div class="error"><p style="color:red">{{$message}}</p></div>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <input type="submit" class="btn btn-primary mb-3 crearnew" value="Enviar petición">
                            
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
