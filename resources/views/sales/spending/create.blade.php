@extends('layouts.main')


@section('menu-heading')
    Pengeluaran
@endsection

@section('title')
    Tambah Pengeluaran
@endsection

@section('content')

@include('layouts.sweet-alert')
<div class="card">
    <div class="card-header">
        <a href="{{ route('spending.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form action="{{ route('spending.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tanggal Pengeluaran</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="date" id="created_at" class="form-control" name="created_at"
                            placeholder="Tanggal Pengeluaran" required>
                        </div>
                        <div class="col-md-4">
                            <label>Deskripsi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea class="form-control" id="desc" name="desc" placeholder="Deskripsi" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label>Nominal</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="nominal" class="form-control" name="nominal"
                            placeholder="Nominal" autocomplete="off">
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary mb-1 mx-2"><i class="fa-solid fa-plus"></i> Tambah</button>
                            <button type="reset" class="btn btn-sm btn-warning mb-1"><i class="fa-solid fa-arrows-rotate"></i> Reset </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection