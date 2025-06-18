@extends('layouts.customer')

@section('title', 'Ro\'yxatdan o\'tish')

@section('content')
    <h4 style="text-align: center; margin-bottom: 2rem; font-weight: 600; font-size: 1.5rem;">Yangi Akkaunt Ochish</h4>
    <form method="POST" action="{{ route('customer.register') }}">
        @csrf

        <div class="form-group">
            <label for="full_name" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">To'liq ismingiz (F.I.Sh)</label>
            <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required placeholder="Masalan: Aliev Vali G'anievich">
            @error('full_name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="passport_number" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Pasport seriyasi va raqami</label>
            <input id="passport_number" type="text" class="form-control @error('passport_number') is-invalid @enderror" name="passport_number" value="{{ old('passport_number') }}" required placeholder="Masalan: AA1234567">
            @error('passport_number')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Telefon raqamingiz</label>
            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required placeholder="+998901234567">
            @error('phone_number')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email manzilingiz</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="sizning@email.com">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Parol</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Kamida 8 belgi">
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Parolni tasdiqlang</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Parolni qayta kiriting">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Ro'yxatdan o'tish
            </button>
        </div>

        <div class="auth-links">
            <p>Akkauntingiz bormi? <a href="{{ route('customer.login') }}">Kirish</a></p>
        </div>
    </form>
@endsection
