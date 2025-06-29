@extends('layouts.customer_app')

@section('title', 'Shaxsiy Kabinet')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h4 style="margin: 0; font-weight: 600; font-size: 1.5rem;">Xush kelibsiz, {{ $customer->full_name }}!</h4>
    </div>

    @if(session('success'))
        <div style="padding: 1rem; margin-bottom: 1rem; background-color: #c6f6d5; color: #22543d; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="padding: 1rem; margin-bottom: 1rem; background-color: #fed7d7; color: #822727; border-radius: 8px;">
            {{ session('error') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h5 style="font-weight: 600;">Mening Qurilmalarim</h5>
        <a href="{{ route('customer.devices.create') }}" class="btn btn-primary" style="padding: 0.5rem 1rem;">+ Yangi Qurilma Qo'shish</a>
    </div>
    <hr style="margin: 1rem 0 1.5rem 0;">

    @forelse($devices as $device)
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.25rem; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 1rem;">
            <div>
                <strong style="display: block; font-size: 1.1rem;">{{ $device->model_name }}</strong>
                <small style="color: #718096;">IMEI: {{ $device->imei }}</small> <br>
                <small style="color: #718096;">
                    Holati:
                    @if($device->status == 'active')
                        <span style="color: #38a169;">● Faol</span>
                    @else
                        <span style="color: #e53e3e;">● Bloklangan</span>
                    @endif
                </small>
            </div>
            <div style="display: flex; gap: 0.5rem; align-items: center;">
                <a href="{{ route('customer.devices.show', $device->id) }}" class="btn" style="background-color: #f0f4f8; color: #4a5568;">Batafsil</a>
                @if($device->managed_by_company_id === null)
                    <form action="{{ route('customer.devices.changeStatus', $device->id) }}" method="POST">
                        @csrf
                        @if($device->status == 'active')
                            <button type="submit" class="btn" style="background-color: #e53e3e; color: #fff;">Bloklash</button>
                        @else
                            <button type="submit" class="btn" style="background-color: #38a169; color: #fff;">Aktivlashtirish</button>
                        @endif
                    </form>
                @else
                    <span style="font-size: 0.9rem; color: #4a5568; background-color: #edf2f7; padding: 0.4rem 0.8rem; border-radius: 16px;">
                        {{ $device->managingCompany->name }} boshqaruvida
                    </span>
                @endif
            </div>
        </div>
    @empty
        <p>Sizda hali qurilmalar mavjud emas. Yuqoridagi "+ Yangi Qurilma Qo'shish" tugmasini bosib, birinchisini qo'shing.</p>
    @endforelse
@endsection
