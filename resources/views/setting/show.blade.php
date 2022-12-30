@extends('layouts.main')

@section('menu-heading')
    Kelola Toko
@endsection

@section('title')
    Detail Toko
@endsection

@section('content')
<section id="multiple-column-form">
    @include('layouts.sweet-alert')
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('settings.index') }}"><i class="fa-solid fa-angles-left"></i> Kembali</a>
                </div>
                <div class="card-content">
                    <div class="card-body table-responsive">
                        {{-- Start Form Action  --}}
                        <form action="{{ route('settings.update', $setting) }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <div class="form-group">
                                    <label for="name">Nama Toko</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $setting->name }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-8 col-12">
                                <div class="form-group">
                                    <label for="owner_name">Nama Pemilik</label>
                                    <input type="text" id="owner_name" class="form-control" name="owner_name" value="{{ $setting->owner_name }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-8 col-12">
                                <div class="form-group">
                                    <label for="name">Nomer Tlp</label>
                                    <input type="number" id="number_phone" class="form-control" name="number_phone" value="{{ $setting->number_phone }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea id="address" class="form-control" name="address" rows="4" autocomplete="off" placeholder="Alamat"> {{ $setting->address }} </textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <img class="img-preview img-fluid d-block border border-4 mb-3 mt-1" src="{{ asset('storage/'.$setting->image) }}" alt="Logo" width="100">
                                    <input type="file" class="d-none form-control" id="image" name="image">
                                    <label for="image" class="btn btn-sm btn-square btn-primary" width="100">
                                    <i class="fa fa-upload me-2"></i>Unggah Logo
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-sm btn-primary mb-1"><i class="fa-solid fa-edit"></i> Update</button>
                            </div>
                        </div>
                        {{-- End Form Action Update Store Settings --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection