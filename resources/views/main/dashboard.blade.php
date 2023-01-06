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
        <div class="col-md-8">
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
        </div>
    </section>

    <section class="row">
        @include('main.dashboard-table')
    </section>
</div>

    @include('main.dashboard-script')

@endsection

