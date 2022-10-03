@extends('layouts.main')

@section('menu-heading')
    Produk    
@endsection

@section('title')
    Data Produk
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">

        <div class="card">    
            <div class="card-header">
                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary block my-1">Tambah Produk</a>
                <a href="" class="btn btn-sm btn-info block my-1" target="_blank">Cetak Data Produk</a>
            
            <form action="{{ route('product.delete_selected') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm btn-delete my-1"> Hapus Data Yang Dipilih</button>
            </div>

            <div class="card-body">
                <div class=""><input type="checkbox" name="select_all" id="select_all"> Pilih Semua</div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>Kode Produk</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga / Pcs</th>
                            <th>Image</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                    @if (count($product) > 0)
                        @foreach ($product as $product )
                            <td><input type="checkbox" name="id[{{ $product->id }}]" id="id" value="{{ $product->id }}"></td>
                            <td><a href="{{ route('product.show', $product->id) }}" class="badge bg-success text-light">{{ $product->code_product }}</a></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>Rp{{ number_format($product->price_sell) }}</td>
                            <td><img class="rounded-circle" width="45px" src="{{ asset('storage/'.$product ->image) }}" alt="Foto Produk"></td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('product.show', $product->id) }}"> <i class="fas fa-eye"></i>  Preview Detail</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </section>
@endsection