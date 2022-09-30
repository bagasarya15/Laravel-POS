@extends('layouts.main')

@section('menu-heading')
    Transaksi Penjualan
@endsection

@section('title')
    Kasir
@endsection

@section('content')

@include('layouts.sweet-alert')
<section class="section">
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Default Layout</h4>
        </div>
        <div class="card-body">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam,
        commodi? Ullam quaerat similique iusto temporibus, vero aliquam
        praesentium, odit deserunt eaque nihil saepe hic deleniti?
        Placeat delectus quibusdam ratione ullam!
        </div>
         <button type="button" class="btn btn-danger mb-1 mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Pilih Produk</button>
    </div>
</section>

<section id="modal">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input type="password" id="current_password" class="form-control" name="current_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" id="password" class="form-control" name="password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"> <i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                    <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-edit"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection