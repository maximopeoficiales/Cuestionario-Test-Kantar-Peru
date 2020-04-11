@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body animated bounce">
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center">
                            @php
                                /* no es lo optimo pero como solo hare un consulta */
                                $logo= App\Models\Empresa::where('id_company',1)->get();
                                foreach ($logo as $l) {
                                    echo '<img src="'. $l->logo.'" style="width: 100%; height:30%px; border-radius: 5%;">';
                                }
                            @endphp                            
                        </div>
                        <div class="col-md-9">
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                
                                <br>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Email:') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Recuerdame') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Ingresar') }}
                                        </button>
        
                                        <a class="btn btn-link text-primary" id="btnModal">
                                            {{ __('Olvidaste tu contraseña?') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- mostrar aviso  --}}
<!-- Button trigger modal -->
<button type="button" class="d-none" data-toggle="modal" data-target="#exampleModal" id="abrimodal">
</button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-white" id="exampleModalLabel">¿Olvidaste tu contraseña?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Por favor contactate con <b>ayuda@kantar.com</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
    <script>
        $(document).ready(function () {
            /* accion de no me recuerdo mi contraseña */
            $("#btnModal").click(function () { 
                let btnMostrarModal=document.getElementById("abrimodal");
                btnMostrarModal.click();
            });
        });
        
    </script>
@endpush
@endsection
