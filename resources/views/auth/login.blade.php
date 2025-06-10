@extends('layouts.auth')

@section('content')
    <div class="mt-4 position-absolute">
        <a href="{{ route('home') }}">
            <img src="{{ asset('customer-assets/Vector.svg') }}" alt="Back" style="position: relative; z-index: 0"
                class="mt-5 back-btn ms-5" />
        </a>
    </div>

    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; z-index: 1">
        <form method="POST" action="{{ route('login') }}"
            class="d-flex justify-content-center align-items-center flex-column" style="width: 35%">
            @csrf

            <div class="p-3 bg-white container-lg form-div rounded-4">
                <div class="mx-2">
                    <p class="fw-semibold fs-4 " style="letter-spacing: 0.1rem;">Login.</p>

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

                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-3 btn btn-outline-light fw-bold form-div" style="letter-spacing: 0.6rem; color: black;">
                LOGIN
            </button>
        </form>
    </div>
@endsection
