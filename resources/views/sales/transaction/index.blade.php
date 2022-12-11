@extends('layouts.main')

@section('menu-heading')
    Transaksi
@endsection

@section('title')
    Transaksi Penjualan
@endsection

@section('content')
    @livewire('transaction.index')
@endsection