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
                <a href="{{ route('product.create') }}" class="btn btn-xs btn-primary block">Tambah Produk</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Image</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach ($product as $product )
                            <td><a href="{{ route('product.show', $product->id) }}" class="badge bg-success text-light">{{ $product->code_product }}</a></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><img class="rounded-circle" width="45px" src="{{ asset('storage/'.$product ->image) }}" alt="Foto Produk"></td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('product.show', $product->id) }}"> <i class="fas fa-eye"></i>  Preview Detail</a>
                                    {{-- <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fa-solid fa-trash btn btn-xs btn-danger btn-delete" id="btn-delete"></button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection