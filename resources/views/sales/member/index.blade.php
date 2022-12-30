@extends('layouts.main')

@section('menu-heading')
    Member
@endsection

@section('title')
    Data Member
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('member.create') }}"class="btn btn-sm btn-primary block" > Tambah Member</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table dataTable1 table-hover">
                    <thead>
                        <tr class="small">
                            <th>#</th>
                            <th>Kode Member</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Tlp</th>
                            <th>Status</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $member)
                        <tr class="small">
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-primary">{{ $member->code_member }}</span></td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->address }}</td>
                            <td>{{ $member->number_phone }}</td>
                            <td>{{ $member->member_status }}</td>
                            <td>{{ $member->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-warning"> <i class="fa-solid fa-edit "></i></a> 
                                    <form action="{{ route('member.destroy', $member->id) }}" method="POST">
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