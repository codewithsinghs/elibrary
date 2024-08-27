@extends('layouts.app')
@section('main-content')
    @php
        $bodypadd = auth()->guest() ? 'px-0' : '';
    @endphp

    <div class="content-body {{ $bodypadd }}">
        <div class="container-fluid">
            <div class="row align-items-center justify-contain-center">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row ">
                                <div class="col-xl-6 col-md-6 sign text-center">

                                    <div class="text-center my-5">
                                        <a href="{{ url('') }}"><img width="200"
                                                src="{{ asset('build/assets') }}/img/logo/elibrary.png" alt=""></a>
                                    </div>
                                    <img src="{{ asset('build/assets') }}/images/log.png" width="100%">

                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class=" sign-in-your m-5">
                                        <h2 class="font-w800 text-black">Forgot Password</h2>
                                        <span>Welcome! Please Fill the username/email in form below to recover your
                                            account</span>
                                        <div class="card mb-3">
                                            @include('layouts.sessions')
                                        </div>
                                        @if (session('status'))
                                            <div class="alert alert-success mb-4" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('password.store') }}">
                                            @csrf

                                            <!-- Password Reset Token -->
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                            <!-- Email -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="email" class="text-label form-label">Email Address <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"> <i class="fa fa-user"></i>
                                                        </span>
                                                        <input type="email" id="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" placeholder="example@example.com"
                                                            value="{{ old('email', $request->email) }}" required autofocus
                                                            autocomplete="username">
                                                    </div>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <!--  Password* -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="password" class="mb-1"><strong>Password</strong></label>
                                                    <div class="input-group">
                                                        <!-- <span class="input-group-text"> <i class="fa fa-lock"></i> </span>  -->
                                                        <input type="password" name="password"
                                                            class="form-control validated-input password-input "
                                                            id="passwordInput" data-validation-type="password"
                                                            data-error-field="password_error" placeholder="********"
                                                            value="{{ old('password') }}" required>
                                                        <span class="input-group-text show-pass" id="togglePasswordView">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                    <div class="error-message text-danger" id="password_error"></div>

                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Confirm Password* -->
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="mb-1"><strong>Confirm
                                                            Password </strong><span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <!-- <span class="input-group-text"> <i class="fa fa-lock"></i> </span>  -->
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control validated-input confirm-password-input"
                                                            id="cnfPasswordInput" placeholder="*********"
                                                            data-error-field="confirm_password_error"
                                                            value="{{ old('password_confirmation') }}" required
                                                            autocomplete="new-password">
                                                        <span class="input-group-text show-pass" id="togglePasswordView2">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                    <div class="error-message text-danger" id="confirm_password_error">
                                                    </div>
                                                    @error('password_confirmation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                            </div>

                                        </form>
                                        <div class="new-account mt-3">
                                            <p>Remmber Password? <a class="text-primary" href="{{ route('login') }}">Sign
                                                    in</a></p>
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
