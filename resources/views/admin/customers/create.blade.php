@extends('layouts.admin')

@section('title', 'Yangi Mijoz Qo\'shish')

@section('content-header', 'Yangi Mijoz Qo\'shish')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.customers.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="full_name">To'liq Ism (F.I.Sh)</label>
                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                           placeholder="Mijozning to'liq ismini kiriting" value="{{ old('full_name') }}">
                    @error('full_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="passport_number">Pasport Seriyasi va Raqami</label>
                    <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" id="passport_number"
                           placeholder="AA1234567" value="{{ old('passport_number') }}">
                    @error('passport_number')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Telefon Raqami</label>
                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                           placeholder="+998901234567" value="{{ old('phone_number') }}">
                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Manzili (Ixtiyoriy)</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                           placeholder="Mijoz emailini kiriting" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <hr>
                <p class="text-muted">Mijoz tizimga mustaqil kirishi uchun login-parol (ixtiyoriy).</p>

                <div class="form-group">
                    <label for="password">Parol</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                           placeholder="Parol kiriting">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Saqlash</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Bekor Qilish</a>
            </form>
        </div>
    </div>
@endsection
