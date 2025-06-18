@extends('layouts.customer')

@section('title', 'Yangi Qurilma Qo\'shish')

@section('content')
    <h4 style="text-align: center; margin-bottom: 2rem;">Yangi Qurilmani Qo'shish</h4>
    <form method="POST" action="{{ route('customer.devices.store') }}">
        @csrf

        <div class="form-group">
            <input id="model_name" type="text" class="form-control @error('model_name') is-invalid @enderror"
                   name="model_name" value="{{ old('model_name') }}" required placeholder="Qurilma modeli (masalan, Samsung A51)">
            @error('model_name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <input id="imei" type="text" class="form-control @error('imei') is-invalid @enderror"
                   name="imei" value="{{ old('imei') }}" required placeholder="Qurilmaning 15 xonali IMEI raqami">
            @error('imei')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">
                Qo'shish
            </button>
        </div>

        <div class="auth-links">
            <a href="{{ route('customer.dashboard') }}">Orqaga qaytish</a>
        </div>
    </form>
@endsection
