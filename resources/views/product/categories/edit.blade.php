@extends('layouts.main')

@section('menu-heading')
    Produk    
@endsection

@section('title')
  Edit Kategori Produk
@endsection

@section('content')

@include('layouts.sweet-alert')
<div class="card">
    <div class="card-header">
        <a href="{{ route('category.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form action="{{ route('category.update', $category->id) }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Jenis Kategori" autocomplete="off" value="{{ old('name',$category->name) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Deskripsi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="desc" class="form-control" name="desc"
                                placeholder="Deskripsi" autocomplete="off" value="{{ old('desc',$category->desc) }}">
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                            <button type="reset" class="btn btn-warning me-1 mb-1"><i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection