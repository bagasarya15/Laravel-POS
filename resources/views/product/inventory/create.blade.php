@extends('layouts.main')

@section('menu-heading')
    Produk    
@endsection

@section('title')
  Tambah Produk
@endsection

@section('content')

@include('layouts.sweet-alert')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-title mt-2 ms-3">
                <a href="{{ route('product.index') }}" class="small"><i class="fa-solid fa-angles-left"></i> Kembali</a>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="col-md-8">
                        {{-- Start Form Action  --}}
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                        @csrf
                        <img class="img-preview card-img-top img-fluid d-block" src="{{ asset('storage/product/default.png') }}" alt="Product Image" width="100">
                    </div>

                    <div class="d-flex justify-content-start mx-3">
                        <label for="image" class="btn btn-xs btn-square btn-primary" width="100">
                        <i class="fa fa-upload me-2"></i>Unggah Foto Produk
                        </label>
                    </div>

                    <input type="file" class="d-none @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kode Produk</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="code_product" class="form-control bg-dark fw-bold" name="code_product" autocomplete="off" value="{{ $generateCode }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" value="{{ old('name') }}">
                                @error('name')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Kategori</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" id="basicSelect">
                                    <option selected disabled>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Stok</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="stok" class="form-control @error('stok') is-invalid @enderror" name="stok" autocomplete="off" value="{{ old('stok') }}">
                                @error('stok')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Harga Beli</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="price_buy" class="form-control @error('price_buy') is-invalid @enderror" name="price_buy" autocomplete="off" value="{{ old('price_buy') }}">
                                @error('price_buy')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Harga Jual</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="price_sell" class="form-control @error('price_sell') is-invalid @enderror" name="price_sell" autocomplete="off" value="{{ old('price_sell') }}">
                                @error('price_sell')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Deskripsi Produk</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="exampleFormControlTextarea1" rows="3" autocomplete="off" value="{{ old('desc') }}"></textarea>
                                @error('desc')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary mb-1"><i class="fa-solid fa-plus"></i> Tambah</button>
                                <a href="{{ route('product.create') }}" type="reset" class="btn btn-warning mb-1 mx-2   "><i class="fa-solid fa-arrows-rotate"></i> Reset </a>
                            </form>
                            {{-- End Form Action Add --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection