@extends('layouts.main')

@section('menu-heading')
    Pengaturan
@endsection

@section('title')
    Kelola Akun
@endsection

@section('content')

@include('layouts.sweet-alert')
    <section class="section">
        <div class="card">
            <div class="card-body table-responsive">
                <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"> Tambah Data</button>
                <table class="table dataTable1 table-hover">
                    <thead>
                        <tr class="small">
                            <th>#</th>
                            <th>Hak Akses</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Terakhir Login</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($user as $user_access)
                        <tr class="small">
                            <td>{{ $i++ }}</td>

                            <td>
                                @if ($user_access->id  == 1 || $user_access->id  == 2)
                                    <span class="badge rounded-pill bg-primary">Super-Admin</span>
                                @else
                                    <span class="badge rounded-pill bg-{{ ($user_access->role->login_access  == 'Admin') ? 'info' : (($user_access->role->login_access  == 'Sub-Admin') ? 'secondary' : 'warning') }}">{{ $user_access->role->login_access  }}</span>
                                @endif
                            </td>

                            <td>{{ $user_access->username }}</td>
                            <td>{{ $user_access->name }}</td>
                            <td>{{ $user_access->email}}</td>

                            <td>
                                {{-- @if ($user_access->is_login == 1)
                                    {{ 'Sedang Login' }}
                                @elseif($user_access->last_login == null)
                                    {{ 'Belum Pernah Login' }}
                                @else
                                    {{ \Carbon\Carbon::parse($user_access->last_login)->diffForHumans() }}
                                @endif --}}

                                @if($user_access->last_login == null)
                                    {{ 'Belum Pernah Login' }}
                                @else
                                    {{ \Carbon\Carbon::parse($user_access->last_login)->diffForHumans() }}
                                @endif
                            </td>

                            <td>
                                <div class="d-inline-flex">
                                    <a href="{{ route('user-access.show', $user_access->id) }}" class="btn btn-sm btn-primary mx-1"> <i class="fas fa-eye"></i></a> 
                                    @can('super-admin')
                                    <form action="{{ route('user-access.destroy', $user_access->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete"> <i class="fas fa-trash"></i></button> 
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section for="modal-system-update">
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <form action="{{ route('user-access.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                <div class="col-md-4">
                                    <label>Hak Akses <span class="small text-danger"> *</span></label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select name="role_id" id="role_id" class="form-select" id="basicSelect">
                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}">{{ $item->login_access}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Username  <span class="small text-danger"> *</span></label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
                                </div>

                                <div class="col-md-4">
                                    <label>Nama <span class="small text-danger"> *</span></label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Nama" autocomplete="off">
                                </div>

                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off">
                                </div>

                                <div class="col-md-4">
                                    <label>Password  <span class="small text-danger"> *</span></label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" id="check-new-pass" class="form-check-input form-check-primary">
                                        <label class="form-check-label">Lihat Password</label>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label>Konfirmasi Password  <span class="small text-danger"> *</span></label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" id="check-confirm-pass" class="form-check-input form-check-primary">
                                        <label class="form-check-label">Lihat Password</label>
                                    </div>
                                </div>
                                <input type="hidden" value="avatar/default.jpg" name="image">
                            </div>
                            <small class="text-danger fst-italic" style="font-size: 13px">* Wajib diisi</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah</button>
                    <button type="reset" class="btn btn-sm btn-warning"> <i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection