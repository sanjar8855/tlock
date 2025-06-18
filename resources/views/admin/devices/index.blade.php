@extends('layouts.admin')

@section('title', 'Qurilmalar Ro\'yxati')
@section('content-header', 'Qurilmalar')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Barcha Qurilmalar</h3>
            <div class="card-tools">
                <a href="{{ route('admin.devices.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Yangi Qurilma Qo'shish
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>IMEI</th>
                    <th>Mijoz (Egasi)</th>
                    <th>Boshqaruvchi</th>
                    <th>Status</th>
                    <th>Amallar</th>
                </tr>
                </thead>
                <tbody>
                @forelse($devices as $device)
                    <tr>
                        <td>{{ $device->id }}</td>
                        <td>{{ $device->model_name }}</td>
                        <td>{{ $device->imei }}</td>
                        <td>{{ $device->customer->full_name }}</td>
                        <td>
                            @if($device->managingCompany)
                                <span class="badge badge-info">{{ $device->managingCompany->name }}</span>
                            @else
                                <span class="badge badge-secondary">Shaxsiy boshqaruv</span>
                            @endif
                        </td>
                        <td>
                            @if($device->status == 'active')
                                <span class="badge badge-success">Faol</span>
                            @else
                                <span class="badge badge-danger">Bloklangan</span>
                            @endif
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('admin.devices.edit', $device->id) }}"
                               class="btn btn-warning btn-sm mr-1">Tahrirlash</a>

                            @if($device->managed_by_company_id)
                                <form action="{{ route('admin.devices.changeStatus', $device->id) }}" method="POST"
                                      onsubmit="return confirm('Haqiqatan ham bu qurilma holatini o\'zgartirmoqchimisiz?');">
                                    @csrf
                                    @if($device->status == 'active')
                                        <button type="submit" class="btn btn-danger btn-sm mr-1">Bloklash</button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-sm mr-1">Aktivlashtirish
                                        </button>
                                    @endif
                                </form>
                                <form action="{{ route('admin.devices.release', $device->id) }}" method="POST"
                                      onsubmit="return confirm('Qurilmani kompaniya boshqaruvidan chiqarmoqchimisiz?');">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm mr-1">Shartnomani yakunlash</button>
                                </form>
                            @endif

                            <form action="{{ route('admin.devices.destroy', $device->id) }}" method="POST"
                                  onsubmit="return confirm('Haqiqatan ham bu qurilmani o\'chirmoqchimisiz? Bu amalni orqaga qaytarib bo\'lmaydi!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Qurilmalar topilmadi.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $devices->links() }}
        </div>
    </div>
@endsection
