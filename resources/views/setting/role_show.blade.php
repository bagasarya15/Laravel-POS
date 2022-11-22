@extends('layouts.main')

@section('menu-heading')
    Role Akses
@endsection

@section('title')
    Detail Role Akses
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

                            <div class="col-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-sm btn-primary btn-ask mb-1"><i class="fa-solid fa-edit"></i> Update</button>
                                {{-- End Form Action Update Role Access Settings --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection