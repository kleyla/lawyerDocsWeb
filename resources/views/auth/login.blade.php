@extends('layouts.public')
@section('contenido')

{{-- <div class="page-header header-filter" style="background-image: url('{{asset('img/academico/uagrm.jpg')}}'); background-size: cover; background-position: top center;"> --}}
   <br><br><br><br><br><br>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card">
            <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
              <div class="card-header card-header-info text-center">
                <h4 class="card-title">Login</h4>
              </div>
              <br>
              <p class="description text-center">Introduce tus datos</p>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="tim-icons icon-email-85"></i>
                    </span>
                  </div>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="tim-icons icon-lock-circle"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contrasenha..." name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <br>
              <div class="text-center">
                  <div class="col-md-12">
                      <button type="submit" class="btn btn-info">
                          {{ __('Login') }}
                      </button>
                  </div>
              </div>
              <br>
            </form>
          </div>
        </div>
      </div>
      <br><br><br><br><br>
    {{-- </div> --}}

@endsection
