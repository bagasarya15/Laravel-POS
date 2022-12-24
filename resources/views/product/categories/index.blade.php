@extends('layouts.main')

@section('menu-heading')
    Produk    
@endsection

@section('title')
  Kategori Produk
@endsection

@section('content')

{{-- @include('layouts.flasher') --}}
@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary block">Tambah Kategori</a>
            </div>
            <div class="card-body">
                <table class="table dataTable1 table-hover">
                    <thead>
                        <tr class="small">
                            <th>#</th>
                            <th>Jenis Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr class="small">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->desc }}</td>
                            <td>
                                <div class="d-flex">
                                    {{-- <button type="button" class="fa-solid fa-pen-to-square btn btn-xs btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#editCategoryModal" ></button> --}}
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning mx-2"> <i class="fa-solid fa-edit"></i> </a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete" id="btn-delete"> <i class="fa-solid fa-trash"></i> </button>
                                    </form>
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