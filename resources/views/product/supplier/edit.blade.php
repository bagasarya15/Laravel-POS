@extends('layouts.main')


@section('menu-heading')
    Supplier    
@endsection

@section('title')
    Edit Supplier
@endsection

@section('content')

@include('layouts.sweet-alert')
<div class="card">
    <div class="card-header">
        <a href="{{ route('supplier.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form action="{{ route('supplier.update', $supplier) }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control" name="name"
                            placeholder="Nama" autocomplete="off" value="{{ old('name', $supplier->name) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea class="form-control" id="address" name="address" placeholder="Alamat" rows="3">{{ old('address', $supplier->address) }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label>No Tlp</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="number_phone" class="form-control" name="number_phone"
                            placeholder="No Tlp" autocomplete="off" value="{{ old('number_phone', $supplier->number_phone) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Keterangan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="desc" class="form-control" name="desc"
                                placeholder="Keterangan" autocomplete="off" value="{{ old('desc', $supplier->desc) }}">
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mb-1 mx-2"><i class="fa-solid fa-edit"></i> Ubah</button>
                            <button type="reset" class="btn btn-warning mb-1"><i class="fa-solid fa-arrows-rotate"></i> Reset </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection