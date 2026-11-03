@extends('layouts.app')

@section('title', 'Create account')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 65vh">
    <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">
        <div class="card">
            <div class="card-body p-4 p-md-5">
                <p class="text-primary fw-semibold mb-2">PRODUCT MANAGER</p>
                <h1 class="h3 page-heading mb-2">Create your account</h1>
                <p class="text-secondary mb-4">Register to access the product dashboard.</p>
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control" autocomplete="name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" autocomplete="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" required>
                        <div class="form-text">Use at least 8 characters.</div>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create account</button>
                </form>
                <p class="text-center text-secondary mt-4 mb-0">Already registered? <a href="{{ route('login') }}">Log in</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
