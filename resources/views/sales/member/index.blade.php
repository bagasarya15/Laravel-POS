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
            <div class="card-body">
                <table class="table dataTable1 table-striped">
                    <thead>
                        <tr>
                            <th>Kode Member</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomer Tlp</th>
                            <th>Status Member</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $member)
                        <tr>
                            <td><span class="badge bg-success">{{ $member->code_member }}</span></td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->address }}</td>
                            <td>{{ $member->number_phone }}</td>
                            <td>{{ $member->member_status }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('member.edit', $member->id) }}" class="btn btn-xs btn-warning fa-solid fa-edit edit-member"></a> 
                                    <form action="{{ route('member.destroy', $member->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fa-solid fa-trash btn btn-xs btn-danger btn-delete mx-2" id="btn-delete"></button>
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