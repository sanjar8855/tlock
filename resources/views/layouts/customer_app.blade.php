<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tellock - Shaxsiy Kabinet')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f6f9;
            color: #1a202c;
            margin: 0;
        }
        .navbar {
            background-color: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            text-decoration: none;
        }
        .main-content {
            padding: 2rem;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1px solid #d2d6dc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-control:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s ease;
        }
        .btn-primary {
            background-color: #4a90e2;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #357ABD;
        }
        .btn-secondary {
            background-color: #e2e8f0;
            color: #4a5568;
        }
        .btn-secondary:hover {
            background-color: #cbd5e0;
        }
        .is-invalid {
            border-color: #e53e3e;
        }
        .invalid-feedback {
            color: #e53e3e;
            font-size: 0.875rem;
            display: block;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="{{ route('customer.dashboard') }}" class="navbar-brand">Tellock</a>
    <div>
        <form action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="background-color: transparent; color: #e53e3e;">Chiqish</button>
        </form>
    </div>
</nav>

<main class="main-content">
    <div class="container">
        <div class="card">
            @yield('content')
        </div>
    </div>
</main>
</body>
</html>
