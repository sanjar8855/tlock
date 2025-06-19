@extends('layouts.admin')

@section('title', 'Boshqaruv Paneli')

@section('content-header', 'Boshqaruv Paneli')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Jami Mijozlar -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalCustomers }}</h3>
                        <p>Jami Mijozlar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.customers.index') }}" class="small-box-footer">Batafsil <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Jami Qurilmalar -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $totalDevices }}</h3>
                        <p>Jami Qurilmalar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-phone-portrait"></i>
                    </div>
                    <a href="{{ route('admin.devices.index') }}" class="small-box-footer">Batafsil <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Faol Qurilmalar -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $activeDevices }}</h3>
                        <p>Faol Qurilmalar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-unlocked"></i>
                    </div>
                    <a href="{{ route('admin.devices.index') }}" class="small-box-footer">Batafsil <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Bloklangan Qurilmalar -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $lockedDevices }}</h3>
                        <p>Bloklangan Qurilmalar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-locked"></i>
                    </div>
                    <a href="{{ route('admin.devices.index') }}" class="small-box-footer">Batafsil <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- .row -->

        <!-- Kelajakda bu yerga grafiklar yoki oxirgi harakatlar ro'yxatini qo'shish mumkin -->

    </div>
@endsection

@push('css')
    <!-- IonIcons (kartochkalardagi ikonkalarni chiroyli qilish uchun) -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
