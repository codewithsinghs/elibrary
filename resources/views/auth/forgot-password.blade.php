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
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf

                                            <div class="my-4">
                                                <label for="email" class="text-label form-label">Email Address <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                    <input type="email" class="form-control" name="email"
                                                      
                                                        placeholder="example@example.com" value="{{ old('email') }}"
                                                        required>
                                                </div>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
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
