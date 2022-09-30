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
                {{-- <button type="button" class="btn btn-xs btn-primary block" data-bs-toggle="modal"
                    data-bs-target="#exampleModalCenter">
                    Tambah Kategori
                </button> --}}
                <a href="{{ route('category.create') }}" class="btn btn-xs btn-primary block">Tambah Kategori</a>
                {{-- <button class="btn btn-primary success-message">COBA</button> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Jenis Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach ($categories as $category)
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->desc }}</td>
                            <td>
                                <div class="d-flex">
                                    {{-- <button type="button" class="fa-solid fa-pen-to-square btn btn-xs btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#editCategoryModal" ></button> --}}
                                    <a href="{{ route('category.edit', $category->id) }}" class="fa-solid fa-edit btn btn-xs btn-warning mx-2"></a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fa-solid fa-trash btn btn-xs btn-danger btn-delete" id="btn-delete"></button>
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

{{-- Start Modal Tambah --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"> Tambah Kategori </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('category.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Kategori</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Jenis Kategori" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Deskripsi</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="desc" class="form-control" name="desc"
                                placeholder="Deskripsi" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    <button type="button" class="btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Tambah --}}
@endsection