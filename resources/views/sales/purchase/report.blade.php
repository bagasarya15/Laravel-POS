@extends('layouts.main')

@section('menu-heading')
    Laporan
@endsection

@section('title')
    Laporan Pembelian
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h6>Print Data Pembelian</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('purchase.print') }}" method="GET" target="__blank">
                    <div class="form-group w-50">
                        <label for="label">Tanggal Awal</label>
                        <input type="date" name="tglAwal" id="tglAwal" class="form-control" required>
                    </div>
                    <div class="form-group my-3 w-50">
                        <label for="label">Tanggal Akhir</label>
                        <input type="date" name="tglAkhir" id="tglAkhir" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-print"></i> Cetak Laporan </button>
                        <button type="reset"  class="btn btn-sm btn-warning"> <i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection