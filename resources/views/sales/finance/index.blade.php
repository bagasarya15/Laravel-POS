@extends('layouts.main')

@section('menu-heading')
    Laporan
@endsection

@section('title')
    Laporan Keuangan
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h6>Print Data Keuangan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('finance.print') }}" method="GET" target="__blank">
                    <div class="form-group w-50">
                        <label for="label">Tanggal Awal</label>
                        <input type="date" name="firstDate" id="firstDate" class="form-control" required>
                    </div>
                    <div class="form-group my-3 w-50">
                        <label for="label">Tanggal Akhir</label>
                        <input type="date" name="lastDate" id="lastDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-print"></i> Cetak Laporan </button>
                        <button type="reset"  class="btn btn-sm btn-warning"> <i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                        {{-- <a href="#" target="__blank" class="btn btn-sm btn-primary" onclick="this.href='print-spending/' + document.getElementById('firstDate').value + '/' + document.getElementById('lastDate').value"> <i class="fas fa-print"></i> Cetak Laporan </a> --}}    
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection