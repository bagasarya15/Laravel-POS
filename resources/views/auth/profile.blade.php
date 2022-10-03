@extends('layouts.main')

@section('menu-heading')
    Pengaturan
@endsection

@section('title')
  Profile
@endsection

@section('content')
<section id="multiple-column-form">
    @include('layouts.sweet-alert')
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        {{-- Start Form Action  --}}
                        <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data" class="form">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control" name="username" value="{{ auth()->user()->username }}" autocomplete="off">
                                </div>
                            </div>
                            <input type="hidden" name="password" value="{{ auth()->user()->password }}">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ auth()->user()->name }}" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{ auth()->user()->email }}" autocomplete="off">
                                </div>
                            </div>

                            <input type="hidden" name="role_id" value="{{ auth()->user()->role_id  }}">
                
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="user-profile">Foto Profile</label>
                                    <img class="img-preview img-fluid d-block border border-4 mb-3 mt-1" src="{{ asset('storage/'. auth()->user()->image) }}" alt="User Image" width="100">
                                    <input type="file" class="d-none form-control" id="image" name="image">
                                    <label for="image" class="btn btn-sm btn-square btn-primary" width="100">
                                    <i class="fa fa-upload me-2"></i>Unggah Foto Profile
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-sm btn-primary mb-1"><i class="fa-solid fa-edit"></i> Update</button>
                                <button type="button" class="btn btn-sm btn-danger mb-1 mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-key"></i> Ubah Password</button>
                            </div>
                        </div>
                        {{-- End Form Action Update Profile --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Start Modal -->
<section id="modal">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('auth.update', $user) }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input type="password" id="current_password" class="form-control" name="current_password">
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" id="check-current-pass" class="form-check-input form-check-primary">
                              <label class="form-check-label">Lihat Password</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" id="password" class="form-control" name="password" >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" id="check-new-pass" class="form-check-input form-check-primary">
                              <label class="form-check-label">Lihat Password</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" id="check-confirm-pass" class="form-check-input form-check-primary">
                              <label class="form-check-label">Lihat Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-sm btn-danger"> <i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa-solid fa-edit"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
