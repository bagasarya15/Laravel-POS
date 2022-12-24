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
    <section class="row">
        @include('main.dashboard-statistic')
        
    <section class="row">
        @include('main.dashboard-table')
    </section>
</div>
@endsection
