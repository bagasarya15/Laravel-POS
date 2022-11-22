@extends('layouts.main')

@section('menu-heading')
    Pengaturan
@endsection

@section('title')
    Role Akses
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($user as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->role->login_access }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('user-access.show', $user->id) }}" class="card-link mb-4"> <i class="fas fa-eye"></i> Lihat Detail</a> 
                                    {{-- <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fa-solid fa-trash btn btn-xs btn-danger btn-delete mx-2" id="btn-delete"></button>
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