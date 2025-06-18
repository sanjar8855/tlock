<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tellock')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f6f9;
            color: #1a202c;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }
        .auth-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-logo a {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a202c;
            text-decoration: none;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control {
            width: 100%;
            padding: 0.9rem 0rem;
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
            display: block;
            width: 100%;
            padding: 0.9rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .btn-primary {
            background-color: #4a90e2;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #357ABD;
        }
        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        .auth-links a {
            color: #4a90e2;
            text-decoration: none;
        }
        .auth-links a:hover {
            text-decoration: underline;
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
<div class="auth-container">
    <div class="auth-logo">
        <a href="/">Tellock</a>
    </div>
    <div class="auth-card">
        @yield('content')
    </div>
</div>
</body>
</html>
