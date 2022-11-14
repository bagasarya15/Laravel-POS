@extends('layouts.main')


@section('menu-heading')
    Pengeluaran
@endsection

@section('title')
    Detail Pengeluaran
@endsection

@section('content')

@include('layouts.sweet-alert')
<div class="card">
    <div class="card-header">
        <a href="{{ route('spending.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
    </div>
    <div class="card-content">
        <div class="card-body">
                    {{-- Start Form Action Update --}}
                    <form action="{{ route('spending.update', $spending) }}" method="POST" class="form form-horizontal">
                    @csrf
                    @method('PUT')
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tanggal Pengeluaran</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="date" id="created_at" class="form-control" name="created_at"
                        placeholder="Tanggal Pengeluaran" required value="{{ date('Y-m-d'); }}">
                    </div>
                    <div class="col-md-4">
                        <label>Deskripsi</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <textarea class="form-control" id="desc" name="desc" placeholder="Deskripsi" rows="3">{{ old('spending', $spending->desc) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label>Nominal</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="number" id="nominal" class="form-control" name="nominal"
                        placeholder="Nominal" autocomplete="off" value="{{ old('spending', $spending->nominal) }}">
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary mb-1 mx-2"><i class="fa-solid fa-edit"></i> Update</button>
                    </form>
                    {{-- End Form Action Update --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection