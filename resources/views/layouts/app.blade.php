<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Product Manager') · {{ config('app.name', 'Product Manager') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f5f7fb;
            color: #172033;
        }

        .navbar {
            background: #14213d;
        }

        .navbar-brand,
        .navbar .nav-link {
            color: #fff;
        }

        .navbar .nav-link:hover,
        .navbar-brand:hover {
            color: #c7d2fe;
        }

        .page-heading {
            font-weight: 700;
            letter-spacing: -.03em;
        }

        .card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 8px 26px rgb(22 34 56 / 6%);
        }

        .table > :not(caption) > * > * {
            padding: .9rem .75rem;
            vertical-align: middle;
        }

        .product-thumb {
            width: 54px;
            height: 54px;
            object-fit: cover;
            border-radius: .65rem;
        }

        .form-label {
            font-weight: 600;
        }

        .store-product-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            background: #eef1f6;
        }

        .store-detail-image {
            width: 100%;
            max-height: 580px;
            object-fit: contain;
        }

        .dashboard-eyebrow {
            color: #5368d8;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .dashboard-date {
            background: #fff;
            border: 1px solid #e8ebf2;
            border-radius: .7rem;
            color: #687386;
            font-size: .875rem;
            padding: .55rem .8rem;
        }

        .dashboard-button-icon {
            height: 1rem;
            margin: -.15rem .3rem 0 -.15rem;
            vertical-align: middle;
            width: 1rem;
        }

        .dashboard-stat-card {
            border: 1px solid #edf0f5;
            box-shadow: 0 4px 18px rgb(22 34 56 / 4%);
        }

        .dashboard-stat-label {
            color: #687386;
            font-size: .9rem;
            font-weight: 600;
        }

        .dashboard-stat-value {
            color: #172033;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -.045em;
            line-height: 1.15;
        }

        .dashboard-stat-note,
        .dashboard-section-note {
            color: #8a93a3;
            font-size: .82rem;
        }

        .dashboard-stat-icon {
            align-items: center;
            border-radius: .8rem;
            display: inline-flex;
            height: 2.8rem;
            justify-content: center;
            width: 2.8rem;
        }

        .dashboard-stat-icon svg,
        .dashboard-empty-icon svg {
            height: 1.4rem;
            width: 1.4rem;
        }

        .dashboard-stat-icon--products {
            background: #eef2ff;
            color: #5368d8;
        }

        .dashboard-stat-icon--categories {
            background: #f3edff;
            color: #805ad5;
        }

        .dashboard-stat-icon--branches {
            background: #e8f7f2;
            color: #21866a;
        }

        .dashboard-recent-card {
            overflow: hidden;
        }

        .dashboard-view-all {
            align-items: center;
            color: #4b5565;
            display: inline-flex;
            font-size: .875rem;
            font-weight: 600;
            gap: .55rem;
        }

        .dashboard-view-all:hover {
            background: #edf0f5;
            color: #172033;
        }

        .dashboard-table {
            --bs-table-hover-bg: #fafbfe;
        }

        .dashboard-table thead th {
            background: #f8f9fc;
            border-bottom: 1px solid #edf0f5;
            color: #8a93a3;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .07em;
            padding: .8rem 1.25rem;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .dashboard-table tbody td {
            border-color: #f0f2f6;
            padding: .8rem 1.25rem;
        }

        .dashboard-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .dashboard-product-link {
            color: #172033;
            text-decoration: none;
        }

        .dashboard-product-link:hover {
            color: #4358c9;
        }

        .dashboard-product-link .product-thumb {
            flex: 0 0 46px;
            height: 46px;
            width: 46px;
        }

        .dashboard-table-tag {
            background: #f2f4f8;
            border-radius: 999px;
            color: #596579;
            display: inline-block;
            font-size: .78rem;
            padding: .32rem .65rem;
        }

        .dashboard-empty-state {
            border-top: 1px solid #f0f2f6;
        }

        .dashboard-empty-icon {
            align-items: center;
            background: #f2f4f8;
            border-radius: 50%;
            color: #758095;
            display: inline-flex;
            height: 3rem;
            justify-content: center;
            width: 3rem;
        }

        @media (max-width: 575.98px) {
            .dashboard-table thead th,
            .dashboard-table tbody td {
                padding-left: .85rem;
                padding-right: .85rem;
            }

            .dashboard-product-link {
                gap: .6rem !important;
            }

            .dashboard-product-link .product-thumb {
                flex-basis: 38px;
                height: 38px;
                width: 38px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">Product Store</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavigation"
                aria-controls="mainNavigation"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                    @auth
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="nav-link" href="{{ route('products.index') }}">Manage products</a>
                    @endauth
                </div>
                @auth
                    <span class="navbar-text me-lg-3">Hi, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2 mt-lg-0">
                        @csrf
                        <button class="btn btn-outline-light btn-sm" type="submit">Log out</button>
                    </form>
                @else
                    <a class="btn btn-outline-light btn-sm mt-2 mt-lg-0" href="{{ route('login') }}">Admin login</a>
                @endauth
            </div>
        </div>
    </nav>

<main class="container py-4 py-lg-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <div class="fw-semibold mb-1">Please correct the following:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
