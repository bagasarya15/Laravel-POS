@extends('layouts.main')

@section('menu-heading')
    Transaksi
@endsection

@section('title')
    Pengeluaran
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('spending.create') }}" class="btn btn-sm btn-primary block" > Tambah Pengeluaran</a>
            </div>
            <div class="card-body">
                <table class="table dataTable1 table-hover">
                    <thead>
                        <tr class="small">
                            <th>#</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spending as $spend)
                        <tr class="small">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $spend->created_at }}</td>
                            <td>{{ $spend->desc }}</td>
                            <td>Rp {{ number_format($spend->nominal) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('spending.edit', $spend->id) }}" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i></a>
                                    {{-- Start Form Action Delete --}}
                                    <form action="{{ route('spending.destroy', $spend) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete mx-2"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    {{-- End Form Action Delete --}}
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