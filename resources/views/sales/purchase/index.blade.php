@extends('layouts.main')

@section('menu-heading')
    Transaksi
@endsection

@section('title')
    Pembelian
@endsection

@section('content')
    @livewire('purchase.index')
@endsection