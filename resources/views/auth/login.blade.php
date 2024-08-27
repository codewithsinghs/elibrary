@extends('layouts.app')
@section('main-content')
    @php
        $bodypadd = auth()->guest() ? 'px-0' : '';
    @endphp

    <div class="content-body {{ $bodypadd }}">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-contain-center">
                <div class="col-xl-12 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row m-0">
                                <div class="col-xl-6 col-md-6 sign text-center">
                                    <div>
                                        <div class="text-center my-5">
                                            <a href="{{ url('') }}"><img width="200"
                                                    src="{{ asset('build/assets') }}/img/logo/elibrary.png"
                                                    alt=""></a>
                                        </div>
                                        <img src="{{ asset('build/assets') }}/images/log.png" width="100%">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class=" sign-in-your m-2 shadow-lg p-5">
                                        <h2 class="font-w800 text-black">Sign in your account</h2>
                                        <span>Welcome back! Login with your data that you entered during
                                            registration</span>
                                        <!-- <div class="login-social">
                                                                                <a href="javascript:void(0);" class="btn font-w800 d-block my-4"><i
                                                                                        class="fab fa-google me-2 text-primary"></i>Login with Google</a>
                                                                                <a href="javascript:void(0);" class="btn font-w800 d-block my-4"><i
                                                                                        class="fab fa-facebook-f me-2 facebook-log"></i>Login with Facebook</a>
                                                                            </div> -->
                                        <div class="card mb-3">
                                            @include('layouts.sessions')
                                        </div>
                                        @if (session('status'))
                                            <div class="alert alert-success mb-4" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="mb-1"><strong>Email</strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"> <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input type="email" name="email" class="form-control" id="email"
                                                        placeholder="email@example.com" value="{{ old('email') }}" required
                                                        autofocus autocomplete="username">
                                                </div>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="mb-1"><strong>Password</strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                    <input class="form-control" value="" type="password"
                                                        name="password" required autocomplete="current-password"
                                                        placeholder="********">
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-between mt-4 mb-2">

                                                <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember my
                                                        preference</label>
                                                </div>

                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                            </div>
                                        </form>
                                        <div class="text-center my-3">
                                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                                        </div>
                                        <div class="text-center my-3"><strong>Don't have an account? <a class="" href="{{ route('register') }}">
                                            Sign Up Here.</a></strong>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
