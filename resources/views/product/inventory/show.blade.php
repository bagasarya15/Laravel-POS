@extends('layouts.main')

@section('menu-heading')
    Produk    
@endsection

@section('title')
    Detail Produk
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
                <div class="col-md-8">
                {{-- Start Form Action  --}}
                <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                @csrf
                @method('PUT')
                    <img class="img-preview card-img-top img-fluid d-block ms-4 " src="{{ asset('storage/'.$product->image) }}" alt="Product Image">
                </div>
                <div class="d-flex justify-content-start mx-3">
                    <label for="image" class="btn btn-xs btn-square btn-primary w-100">
                    <i class="fa fa-upload me-2"></i>Unggah Foto Produk
                    </label>
                    <input type="file" class="d-none" id="image" name="image">
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $product->name }}</h4>
                    <p class="card-text">
                        {{ $product->desc }}
                    </p>
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
                            <input type="text" id="code_product" class="form-control bg-dark fw-bold" name="code_product" autocomplete="off" value="{{ $product->code_product }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control" name="name"
                                value="{{ $product->name }}" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="category_id" id="category_id" class="form-select" id="basicSelect">
                                @foreach ($categories as $category)
                                {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                                <option {{ ($product->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Stok</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="stok" class="form-control" name="stok"
                                value="{{ $product->stok }}" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Harga Beli</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="price_buy" class="form-control" name="price_buy"
                                value="{{ $product->price_buy }}" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Harga Jual</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="price_sell" class="form-control" name="price_sell"
                                value="{{ $product->price_sell }}" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Deskripsi Produk</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" autocomplete="off">{{ $product->desc }}</textarea>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary mb-1"><i class="fa-solid fa-edit"></i> Update</button>
                        </form>
                        {{-- End Form Action Update --}}
                        {{-- Start Form Action For Delete --}}
                        <form action="{{ route('product.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-1 btn-delete mx-2"><i class="fa-solid fa-trash"></i> Hapus</button>
                        </form>
                        {{-- End Form Action Delete --}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
