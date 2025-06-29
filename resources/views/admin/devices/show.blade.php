@extends('layouts.admin')

@section('title', 'Qurilma: ' . $device->model_name)

@section('content-header', 'Qurilma: ' . $device->model_name)

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Qurilma Ma'lumotlari</h3>
                </div>
                <div class="card-body">
                    <p><strong>Model:</strong> {{ $device->model_name }}</p>
                    <p><strong>IMEI:</strong> {{ $device->imei }}</p>

                    <p><strong>Egasi:</strong> {{ $device->customer?->full_name ?? 'Noma\'lum' }}</p>

                    <p><strong>Status:</strong>
                        @if($device->status == 'active')
                            <span class="badge badge-success">Faol</span>
                        @else
                            <span class="badge badge-danger">Bloklangan</span>
                        @endif
                    </p>
                    <hr>
                    @php
                        $latestLocation = $device->locations->first();
                    @endphp
                    @if($latestLocation)
                        <p><strong>Oxirgi Joylashuv Vaqti:</strong> <br>
                            <small>{{ $latestLocation->created_at->format('d/m/Y H:i') }}</small>
                        </p>
                    @else
                        <p class="text-muted">Joylashuv ma'lumotlari hali mavjud emas.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Joylashuvlar Tarixi</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Vaqti</th>
                            <th>Kenglik (Latitude)</th>
                            <th>Uzunlik (Longitude)</th>
                            <th>Xarita</th> <!-- <<< YANGI USTUN -->
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($locations as $location)
                            <tr>
                                <td>{{ $location->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $location->latitude }}</td>
                                <td>{{ $location->longitude }}</td>
                                <td>
                                    <!-- <<< HAR BIR QATOR UCHUN ALOHIDA LINK >>> -->
                                    <a href="https://www.google.com/maps?q={{ $location->latitude }},{{ $location->longitude }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fas fa-map-marker-alt"></i> Ko'rish
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tarix topilmadi.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $locations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
