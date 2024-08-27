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
                                    <div class=" sign-in-your shadow-lg p-5">
                                        <h2 class="font-w800 text-black">Sign up your account</h2>
                                        <span>Welcome! Please Fill the Registration form Below to Start Your Journey.
                                            Registration</span>
                                        <!-- <div class="login-social">
                                                                                                            <a href="javascript:void(0);" class="btn font-w800 d-block my-4"><i
                                                                                                                    class="fab fa-google me-2 text-primary"></i>Login with Google</a>
                                                                                                            <a href="javascript:void(0);" class="btn font-w800 d-block my-4"><i
                                                                                                                    class="fab fa-facebook-f me-2 facebook-log"></i>Login with Facebook</a>
                                                                                                        </div> -->
                                        <div class="card mb-3">
                                            @include('layouts.sessions')
                                        </div>

                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="row my-2">
                                                <!--First Name -->
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label for="fname" class="text-label form-label">First Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="fname" id="fname"
                                                            class="form-control @error('fname') is-invalid @enderror"
                                                            placeholder="Full Name" value="{{ old('fname') }}" required>
                                                        <!-- <div id="nameError" class="error"></div> -->
                                                        @error('fname')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Last Name -->
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label for="lname" class="text-label form-label">Last Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="lname" id="lname"
                                                            class="form-control @error('lname') is-invalid @enderror"
                                                            placeholder="Full Name" value="{{ old('lname') }}" required>
                                                        <!-- <div id="nameError" class="error"></div> -->
                                                        @error('lname')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Email -->
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label for="email" class="text-label form-label">Email Address
                                                            <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"> <i class="fa fa-user"></i>
                                                            </span>
                                                            <input type="email" id="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" placeholder="example@example.com"
                                                                value="{{ old('email') }}" required>
                                                        </div>
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Date Of Birth -->
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">Date of Birth <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" id="dob"
                                                            class="form-control @error('dob') is-invalid @enderror"
                                                            name="dob" placeholder="YYYY-MM-DD"
                                                            value="{{ old('dob') }}" required>
                                                        @error('dob')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!--  Password* -->
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Password</strong></label>
                                                        <div class="input-group">
                                                            <!-- <span class="input-group-text"> <i class="fa fa-lock"></i> </span>  -->
                                                            <input type="password" name="password"
                                                                class="form-control validated-input password-input "
                                                                id="passwordInput" data-validation-type="password"
                                                                data-error-field="password_error" placeholder="********"
                                                                value="{{ old('password') }}" required>
                                                            <span class="input-group-text show-pass"
                                                                id="togglePasswordView">
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
                                                        <label class="mb-1"><strong>Confirm Password </strong><span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <!-- <span class="input-group-text"> <i class="fa fa-lock"></i> </span>  -->
                                                            <input type="password" name="password_confirmation"
                                                                class="form-control validated-input confirm-password-input"
                                                                id="cnfPasswordInput" placeholder="*********"
                                                                data-error-field="confirm_password_error"
                                                                value="{{ old('password_confirmation') }}" required>
                                                            <span class="input-group-text show-pass"
                                                                id="togglePasswordView2">
                                                                <i class="fa fa-eye-slash"></i>
                                                                <i class="fa fa-eye"></i>
                                                            </span>
                                                        </div>
                                                        <div class="error-message text-danger"
                                                            id="confirm_password_error">
                                                        </div>
                                                        @error('password_confirmation')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row d-flex justify-content-between  mb-2">
                                                <div class="mb-3">
                                                    <div class="form-check custom-checkbox ms-1">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="basic_checkbox_1">
                                                        <label class="form-check-label" for="basic_checkbox_1">Remember my
                                                            preference</label>
                                                    </div>
                                                </div>
                                                <!-- <div class="mb-3">
                                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                                            </div> -->
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Sign Me
                                                    In</button>
                                            </div>
                                        </form>

                                        <div class="new-account mt-3 text-center">
                                            <p><strong>Already have an account? <a class="text-primary"
                                                    href="{{ route('login') }}">Sign in</a></strong></p>
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

{{-- <form action="">
    @csrf
    <!-- <div class="mb-3">
        <label class="mb-1"><strong>Username</strong></label>
        <input type="text" class="form-control" placeholder="name" required autofocus autocomplete="name">
    </div>
    <div class="mb-3">
        <label class="mb-1"><strong>Email</strong></label>
        <input type="email" class="form-control" placeholder="hello@example.com">
    </div> -->
    <!-- Name -->
    <div>
        <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
        <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required
            autofocus autocomplete="name"
            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required
            autocomplete="email"
            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control"
            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password"
            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('login') }}"
            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">{{ __('Already registered?') }}</a>
        <button type="submit"
            class="inline-block px-6 py-3 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">{{ __('Register') }}</button>
    </div>
    <!-- <div class="mb-3">
            <label class="mb-1"><strong>Password</strong></label>
            <input type="password" class="form-control" value="Password">
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
        </div> -->
</form> --}}



{{-- 
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="index.html"><img src="images/logo-full.png" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4">Sign up your account</h4>
                                <form action="https://getskills.dexignzone.com/xhtml/index.html">
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Username</strong></label>
                                        <input type="text" class="form-control" placeholder="username">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" class="form-control" placeholder="hello@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control" value="Password">
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Already have an account? <a class="text-primary" href="page-page-login.html">Sign in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
