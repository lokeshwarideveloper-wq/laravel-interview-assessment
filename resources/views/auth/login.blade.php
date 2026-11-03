@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 65vh">
    <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">
        <div class="card">
            <div class="card-body p-4 p-md-5">
                <p class="text-primary fw-semibold mb-2">PRODUCT MANAGER</p>
                <h1 class="h3 page-heading mb-2">Welcome back</h1>
                <p class="text-secondary mb-4">Sign in to manage your product catalog.</p>
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control form-control-lg" autocomplete="email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control form-control-lg" autocomplete="current-password" required>
                    </div>
                    <div class="form-check mb-4">
                        <input id="remember" name="remember" type="checkbox" class="form-check-input" value="1">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Log in</button>
                </form>
                <p class="text-center text-secondary mt-4 mb-0">New here? <a href="{{ route('register') }}">Create an account</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
