@extends('layouts.auth')

@section('content')
    <div class="mt-4 position-absolute">
        <a href="{{ route('home') }}">
            <img src="{{ asset('customer-assets/Vector.svg') }}" alt="Back" style="position: relative; z-index: 0"
                class="mt-5 back-btn ms-5" />
        </a>
    </div>

    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; z-index: 1">
        <form method="POST" action="{{ route('register') }}"
            class="d-flex justify-content-center align-items-center flex-column" style="width: 35%">
            @csrf

            <div class="p-3 bg-white container-lg form-div rounded-4">
                <div class="mx-2">
                    <p class="fw-semibold fs-4" style="letter-spacing: 0.1rem">Register.</p>

                    <div class="mb-3">
                        <label for="email" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control mb-1 @error('name') is-invalid @enderror"
                            placeholder="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                            autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control mb-1 @error('email') is-invalid @enderror"
                            placeholder="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password"
                            class="form-control mb-1 @error('password') is-invalid @enderror" placeholder="password"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="mb-1 form-control"
                            placeholder="confirm password" name="password_confirmation" required
                            autocomplete="new-password">
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-3 btn btn-outline-light fw-bold form-div" style="letter-spacing: 0.6rem;color: black;">
                REGISTER
            </button>
        </form>
    </div>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-0 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
