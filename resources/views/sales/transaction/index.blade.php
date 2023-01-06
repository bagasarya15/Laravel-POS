@extends('layouts.main')

@section('menu-heading')
    Transaksi
@endsection

@section('title')
    Transaksi Penjualan
@endsection

@section('content')
    @include('layouts.alert-profile')
    @livewire('transaction.index')
@endsection