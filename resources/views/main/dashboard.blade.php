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
    
    @include('layouts.alert-profile')

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <form action="{{ route('dashboard-search') }}" class="d-inline-flex ms-3">
                    <input type="text" class="form-control" name="firstDate" placeholder="Tanggal Awal" onfocus="(this.type='date')"required>
                    
                    <input type="text" class="form-control ms-2" name="lastDate" placeholder="Tanggal Akhir" onfocus="(this.type='date')" required>
                    <button type="submit" class="btn btn-sm btn-primary ms-2"><i class="fa-solid fa-magnifying-glass"></i></button>

                    <a href="{{ route('dashboard') }}" class="btn btn-warning ms-1"><i class="fa-solid fa-arrows-rotate"></i> </a>
                </form>
            </div>
        </div>
    </div>

    <section class="row">
        @include('main.dashboard-statistic')
    </section>

    <section class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <h4>Grafik Penjualan, Pembelian & Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <div id="chart">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"
                            > 
                                <rect width="100%" height="100%" fill="#dc3545"></rect>
                            </svg>
                            <strong class="me-auto">Peringatan Stok Produk</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"
                            ></button>
                        </div>
                        <div class="toast-body">
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($products as $item)
                                @if ($item->stok <= 10)
                                    <table class="table-responsive">
                                        <tr class="small">
                                            <td class="text-muted">{{ $no++ . '.' }}</td>
                                            <td class="text-muted">{{ 'Stok ' . $item->name . ' tersisa ' . $item->stok . ' segera lakukan re-stok' }}</td>
                                        </tr>
                                    </table>   
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        @include('main.dashboard-table')
    </section>
</div>

    @include('main.dashboard-script')

@endsection

