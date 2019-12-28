@extends('layouts.public')
@section('contenido')

    <div class="container">
            <br><br><br><br>
        <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <div class="card card-login">
                    <form class="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="card-header card-header-info text-center">
                            <h4 class="card-title">Registrate</h4>                
                        </div>
                        <p class="description text-center">Registra tus datos</p>
                        <div class="card-body">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="material-icons">face</i>
                                </span>
                            </div>
                            <input type="text" placeholder="Nick..." class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="material-icons">mail</i>
                                </span>
                            </div>
                            <input type="email" placeholder="Email..." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="material-icons">lock_outline</i>
                                </span>
                            </div>
                            <input type="password" placeholder="Contrasenha..." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    </div>
                                    <input placeholder="Contrasenha..." id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                             
                                </div>
                        </div>
                        <div class="text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br><br>
    </div>

@endsection

