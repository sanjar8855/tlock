@extends('layouts.customer')

@section('title', 'Kirish')

@section('content')
    <form method="POST" action="{{ route('customer.login') }}">
        @csrf

        <div class="form-group">
            <input id="login" type="text"
                   class="form-control @error('login') is-invalid @enderror"
                   name="login" value="{{ old('login') }}" required
                   placeholder="Pasport raqami yoki Email">

            @error('login')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required
                   placeholder="Parol yoki Telefon raqami">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Kirish
            </button>
        </div>

        <div class="auth-links">
            <a href="#">
                Parolni unutdingizmi?
            </a>
            <p class="mt-2">Akkauntingiz yo'qmi? <a href="{{ route('customer.register') }}">Ro'yxatdan o'tish</a></p>
        </div>
    </form>
@endsection
