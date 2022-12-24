@extends('layouts.main')

@section('menu-heading')
    Kelola Akun
@endsection

@section('title')
    Detail User
@endsection

@section('content')
<section id="multiple-column-form">
    @include('layouts.sweet-alert')
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('user-access.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        {{-- Start Form Action  --}}
                        <form action="{{ route('user-access.update', $user_access) }}" method="POST" class="form form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control" name="username" value="{{ $user_access->username }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $user_access->name }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" class="form-control" name="email" value="{{ $user_access->email }}" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Hak Akses</label>
                                    <select name="role_id" id="role_id" class="form-select" id="basicSelect">
                                        @foreach ($role as $role)
                                        <option {{ ($user_access->role_id == $role->id) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->login_access }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @can('super-admin')
                            <div class="d-flex mt-2">
                                <div>
                                    <button type="submit" class="btn btn-sm btn-primary btn-ask mb-1"><i class="fa-solid fa-edit"></i> Update</button>
                                    {{-- End Form Action Update Role Access Settings --}}
                                    </form>
                                </div>
                                
                                <div class="mx-2">
                                    <form class="form-reset" action="{{ route('user.reset-password', $user_access) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-danger" id="ask-reset"><i class="fa-solid fa-arrows-rotate"></i> Reset Password</button>
                                    </form>
                                </div>
                            </div>
                                <small class="mt-4 text-danger fst-italic">* default reset password = user12345</small>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        $(".btn-ask").on("click", function (e) {
            e.preventDefault();
            let form = $(this).parents("form");
            Swal.fire({
                title: "Konfirmasi Perubahan User",
                text: " Anda yakin ingin melakukan perubahan akses pada user yang dipilih ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya ",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        });

        $("#ask-reset").on("click", function (e) {
            e.preventDefault();
            let form = $(this).parents(".form-reset");
            Swal.fire({
                title: "Konfirmasi Reset Password",
                text: " Anda yakin ingin mereset password user yang dipilih ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya ",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
@endsection