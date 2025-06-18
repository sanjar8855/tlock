@extends('layouts.admin')

@section('title', 'Yangi Qurilma Qo\'shish')
@section('content-header', 'Yangi Qurilma Qo\'shish')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.devices.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="customer_id">Mijozni tanlang</label>
                    <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" id="customer_id">
                        <option value="">Mijozni tanlang...</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->full_name }} (P: {{ $customer->passport_number }})</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="model_name">Qurilma Modeli</label>
                    <input type="text" name="model_name" class="form-control @error('model_name') is-invalid @enderror" id="model_name"
                           placeholder="Masalan: iPhone 15 Pro" value="{{ old('model_name') }}">
                    @error('model_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imei">Qurilma IMEI raqami</label>
                    <input type="text" name="imei" class="form-control @error('imei') is-invalid @enderror" id="imei"
                           placeholder="15 xonali IMEI raqamini kiriting" value="{{ old('imei') }}">
                    @error('imei')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Saqlash</button>
                <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary">Bekor Qilish</a>
            </form>
        </div>
    </div>
@endsection
