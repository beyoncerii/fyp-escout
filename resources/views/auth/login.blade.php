@extends('applayout')

@section('content')

<title>Login EScout</title>


    <link rel="stylesheet" href="{{asset('css/register.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <div class="container-sm" style="margin-top: 10%">
        <div class="registerform">
            <h1 class="title">Welcome to Escout!</h1>

            <form action="{{ route('login-store')}}" method="post">
            @csrf

            @if ( session('error'))
            <p class="alert alert-danger">{{ session('error') }}</p>
            @endif

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{old('email')}}"
                placeholder="Enter your email address" required>

                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" value="{{old('password')}}"
                placeholder="Enter your password" required>

                @error('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="button d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-success col-lg-2 col-6 mt-3">Login</button>
                <!-- your form fields here -->

                <div class="form-text text-center text-dark mt-3">Not registered yet? <a href="{{ url('register') }}" class="text-dark fw-bold">Create an Account</a></div>
            </div>

        </form>
        </div>
    </div>

@endsection
