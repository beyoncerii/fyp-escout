@extends('applayoutcoach')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />

<div class="container-sm">
    <div>


        <form action="{{ route('editprofile-store', Auth::user()->id) }}" method="POST">
            @csrf

            @if ($errors->any())
            <p class="alert alert-danger">Please check your input</p>
            @endif

            <div class="box right-box p-4 col-sm-6 mx-auto" style="background-color: rgba(227, 237, 247, 0.548);">

                @if (session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
                @endif

                <h2 class="text-center">Edit your account details</h2>

                <div class="row mb-3 justify-content-center">
                    <label for="inputName" class="col-sm-2 col-form-label"><strong>Name</strong></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ Auth::guard('staff')->user()->name }}" />

                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <div class="row mb-3 justify-content-center">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Email</strong></label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ Auth::guard('staff')->user()->email }}" />

                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted">Format: example@gmail.com</small>

                    </div>
                </div>

                <div class="row mb-3 justify-content-center">
                    <label for="phone" class="col-sm-2 col-form-label"><strong>Phone Num.(+60)</strong></label>
                    <div class="col-sm-8">
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone" value="0{{ old('phone', Auth::guard('staff')->user()->phone) }}"
                            pattern="01[0-9]{8,9}" title="01x-xxx xxxx" />

                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="form-text text-muted">
                            Format: 01x-xxx xxxx
                        </small>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </div>

            </div>

        </form>
    </div>
</div>

@endsection
