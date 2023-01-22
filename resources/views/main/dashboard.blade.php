@extends('layouts.main')

@section('menu-heading')
    Dashboard
@endsection

@section('title')
    Statistics
@endsection

@section('content')

@include('layouts.sweet-alert')   

<div class="page-content">
    <section>
        @include('layouts.alert-profile')
    </section>

    <div class="row">
        @include('main.dashboard-calender')
    </div>

    <section class="row">
        @include('main.dashboard-statistic')
    </section>

    <section class="row">
        @include('main.dashboard-grafik')
    </section>

    <section class="row">
        @include('main.dashboard-table')
    </section>

    <section>
        @include('main.dashboard-script')
    </section>
</div>

@endsection

