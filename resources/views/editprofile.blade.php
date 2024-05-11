@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{asset('css/profile.css')}}" />


<div class="container-sm">
    <!-- Centering the container and making it smaller -->

    <div>
      <!-- Centering the row horizontally -->

<h1>Edit your profile </h1>


      <form >

        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label
            >
            <div class="col-sm-10">
              <input type="text" class="form-control @error('name') is-invalid @enderror"
              name="name"  value=" " />

            </div>
          </div>

        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label
          >
          <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror"
            name="email"  value=" " />


          </div>
        </div>

        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label
            >
            <div class="col-sm-10">
              <input type="tel" pattern="[0-9]{3}[0-9]{2}[0-9]{3}" class="form-control @error('phone') is-invalid @enderror"
              name="phone"  value=" " />


            </div>
          </div>

        <br/>

        <button type="submit" class="btn btn-primary">UPDATE</button
        ><br /><br />
      </form>

    </div>
  </div>

  @endsection
