@extends('layouts.main')

@section('menu-heading')
    Produk    
@endsection

@section('title')
  Tambah Produk
@endsection

@section('content')

@include('layouts.sweet-alert')
<div class="card">
    <div class="card-header"><a href="{{ route('product.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Kode Produk</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="code_product" class="form-control bg-dark fw-bold" name="code_product" autocomplete="off" value="{{ 'PDK-'.$AutoNumber }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Nama Produk" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="category_id" id="category_id" class="default-select form-control">
                                <option selected disabled>Pilih kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Image</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <div class="mb-3">
                                <label for="image" class="btn btn-xs btn-square btn-primary w-100"> <i class="fa fa-upload me-2 "></i>Unggah Foto Produk</label>
                                <input type="file" class="d-none" id="image" name="image">
                                <img src="{{ asset('storage/product/default.png') }}" class="img-preview img-fluid d-block mt-3" width="100px">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="stok" class="form-control" name="stok"
                                placeholder="Stok" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Harga Beli</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="price_buy" class="form-control" name="price_buy"
                                placeholder="Harga Beli" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Harga Jual</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="price_sell" class="form-control" name="price_sell"
                                placeholder="Harga Jual" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Deskripsi Produk</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="test" id="desc" class="form-control" name="desc"
                                placeholder="Deksripsi Produk" autocomplete="off">
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-2 mb-1"><i class="fa-solid fa-plus"></i> Tambah</button>
                            <a href="{{ route('product.create') }}" type="reset" class="btn btn-warning mb-1"><i class="fa-solid fa-arrows-rotate"></i> Reset </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection