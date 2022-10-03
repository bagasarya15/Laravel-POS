@extends('layouts.main')


@section('menu-heading')
    Produk    
@endsection

@section('title')
  Tambah Kategori Produk
@endsection


@section('content')

@include('layouts.sweet-alert')
<div class="card">
    <div class="card-header">
        <a href="{{ route('category.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Jenis Kategori" autocomplete="off" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-4">
                            <label>Deskripsi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="desc" class="form-control" name="desc"
                                placeholder="Deskripsi" autocomplete="off" value="{{ old('desc') }}">
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary mx-2 mb-1"><i class="fa-solid fa-plus"></i> Tambah</button>
                            <button type="reset" class="btn btn-sm btn-warning mb-1"><i class="fa-solid fa-arrows-rotate"></i> Reset </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection