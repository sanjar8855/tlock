@extends('layouts.customer_app')

@section('title', 'Qurilma: ' . $device->model_name)

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h4 style="margin: 0; font-weight: 600; font-size: 1.5rem;">Qurilma: {{ $device->model_name }}</h4>
        <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <h5>Joylashuvlar Tarixi</h5>
    <hr style="margin: 1rem 0 1.5rem 0;">

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
        <tr style="border-bottom: 2px solid #e2e8f0;">
            <th style="padding: 0.75rem;">Vaqti</th>
            <th style="padding: 0.75rem;">Koordinatalar</th>
            <th style="padding: 0.75rem;">Xarita</th>
        </tr>
        </thead>
        <tbody>
        @forelse($locations as $location)
            <tr style="border-bottom: 1px solid #e2e8f0;">
                <td style="padding: 0.75rem;">{{ $location->created_at->format('d/m/Y H:i:s') }}</td>
                <td style="padding: 0.75rem;">{{ $location->latitude }}, {{ $location->longitude }}</td>
                <td style="padding: 0.75rem;">
                    <a href="https://www.google.com/maps?q={{ $location->latitude }},{{ $location->longitude }}" target="_blank" class="btn btn-primary btn-sm" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">
                        Ko'rish
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 2rem;">Bu qurilma uchun joylashuv ma'lumotlari hali mavjud emas.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 2rem;">
        {{ $locations->links() }}
    </div>
@endsection
