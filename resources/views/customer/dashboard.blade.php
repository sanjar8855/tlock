@extends('layouts.customer_app')

@section('title', 'Shaxsiy Kabinet')

@section('content')
    <div style="text-align: left; width: 100%;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h4 style="margin: 0;">Xush kelibsiz, {{ $customer->full_name }}!</h4>
            <form action="{{ route('customer.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" style="background-color: #e53e3e; padding: 0.5rem 1rem;">
                    Chiqish
                </button>
            </form>
        </div>

        @if(session('success'))
            <div
                style="padding: 1rem; margin-bottom: 1rem; background-color: #c6f6d5; color: #22543d; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div
                style="padding: 1rem; margin-bottom: 1rem; background-color: #fed7d7; color: #822727; border-radius: 8px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="display: flex; justify-content: space-between;align-items: center;">
            <h3>Qurilmalarim</h3>
            <a href="{{ route('customer.devices.create') }}" class="btn btn-primary" style="padding: 0.5rem 1rem;">+
                Yangi Qurilma</a>
        </div>
        <hr style="margin-bottom: 1.5rem;">

        @forelse($devices as $device)
            <div
                style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 1rem;">
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
                <div>
                @if($device->managed_by_company_id === null)
                    <!-- Agar shaxsiy boshqaruvda bo'lsa, statusni o'zgartirish tugmasini ko'rsatish -->
                        <form action="{{ route('customer.devices.changeStatus', $device->id) }}" method="POST">
                            @csrf
                            @if($device->status == 'active')
                                <button type="submit" class="btn btn-primary" style="background-color: #e53e3e;">
                                    Bloklash
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary" style="background-color: #38a169;">
                                    Aktivlashtirish
                                </button>
                            @endif
                        </form>
                @else
                    <!-- Aks holda, boshqaruvchi kompaniya nomini ko'rsatish -->
                        <span
                            style="font-size: 0.9rem; color: #4a5568; background-color: #edf2f7; padding: 0.4rem 0.8rem; border-radius: 16px;">
                            {{ $device->managingCompany->name }} boshqaruvida
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <p>Sizda hali qurilmalar mavjud emas.</p>
        @endforelse
    </div>
@endsection
