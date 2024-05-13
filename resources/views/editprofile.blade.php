@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{asset('css/profile.css')}}" />


<div class="container-sm">
    <!-- Centering the container and making it smaller -->

    <div>
      <!-- Centering the row horizontally -->

<h1>Edit your profile </h1>

        @if (session('success'))
        <p class="alert alert-success">{{session('success')}}</p>
        @endif

        <form action="{{route ('editprofile-store'), Auth::user()->id}}" method="POST">
        @csrf

        @if ($errors -> any())
            <p class="alert alert-danger">Please check your input</p>
        @endif

        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label
            >
            <div class="col-sm-10">
              <input type="text" class="form-control @error('name') is-invalid @enderror"
              name="name"  value="{{Auth::user()->name}}" />

              @error('name')
                <div class="invalid-feedback">{{$message}}</div>
              @enderror

            </div>
          </div>

        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label
          >
          <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror"
            name="email"  value="{{Auth::user()->email}}" />

            @error('email')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror

          </div>
        </div>

        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Phone Num.(+60) </label
            >
            <div class="col-sm-10">
              <input type="tel"  class="form-control @error('phone') is-invalid @enderror"
              name="phone"  value="{{Auth::user()->phone}}" />

              @error('phone')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror

            </div>
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">UPDATE</button
        ><br /><br />
      </form>

    </div>
  </div>

  @endsection
