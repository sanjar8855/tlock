@extends('layouts.admin')

@section('title', 'Mijozlar Ro\'yxati')

@section('content-header', 'Mijozlar')

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
            <h3 class="card-title">Barcha Mijozlar</h3>
            <div class="card-tools">
                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Yangi Mijoz Qo'shish
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>To'liq Ism</th>
                    <th>Telefon Raqami</th>
                    <th>Pasport Raqami</th>
                    <th>Qo'shilgan Vaqti</th>
                    <th>Amallar</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->full_name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->passport_number }}</td>
                        <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Ko'rish</a>
                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">O'zgartirish</a>
                            <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Haqiqatan ham bu mijozni o\'chirmoqchimisiz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">O'chirish</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Mijozlar topilmadi.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
