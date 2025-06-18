@extends('layouts.admin')

@section('title', 'Boshqaruv Paneli')

@section('content-header', 'Boshqaruv Paneli')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        Xush kelibsiz, {{ Auth::user()->name }}!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
