@extends('layouts.main')

@section('menu-heading')
    Supplier
@endsection

@section('title')
    Data Supplier
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('supplier.create') }}"class="btn btn-sm btn-primary block" > Tambah Supplier</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table dataTable1 table-hover">
                    <thead>
                        <tr class="small">
                            <th>#</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Nomer Tlp</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $supplier)</span></td>
                        <tr class="small">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>{{ $supplier->number_phone }}</td>
                            <td>{{ $supplier->desc }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-warning"> <i class="fa-solid fa-edit"></i> </a> 
                                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete mx-2" id="btn-delete"> <i class="fa-solid fa-trash "></i></button>
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