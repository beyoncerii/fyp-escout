@extends('applayout')

@section('content')

<title>Login EScout</title>


<link rel="stylesheet" href="{{asset('css/register.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container-sm">
<div class="registerform">
    <h1 class="title">Login</h1>

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

    <div class="button">

        <button type="submit" class="btn btn-primary col-lg-12 col-12 mt-2 mb-3">Login</button>
        <!-- your form fields here -->
        <a class="btn btn-primary col-lg-12 col-12 mt-2 mb-2" href="{{url('register')}}" style="text-decoration: none; color:white">Register to EScout</a>

</div>


    </form>
</div>
</div>
@endsection
