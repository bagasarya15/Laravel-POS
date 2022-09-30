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
                <button type="button" class="btn btn-xs btn-primary block tambahMember" data-bs-toggle="modal"
                    data-bs-target="#exampleModalCenter">
                    Tambah Member
                </button>
                {{-- <a href="{{ route('category.create') }}" class="btn btn-xs btn-primary block">Tambah Kategori</a>
                <button class="btn btn-primary success-message">COBA</button> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kode Member</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomer Tlp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach ($member as $member)
                            <td>{{ $member->code_member }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->address }}</td>
                            <td>{{ $member->number_phone }}</td>
                            <td>
                                <div class="d-flex">
                                    {{-- <button type="button" class="fa-solid fa-pen-to-square btn btn-xs btn-warning mx-2 ubahMember" data-bs-toggle="modal" data-bs-target="#editCategoryModal" ></button> --}}
                                    <a href="{{ route('member.show', $member->id) }}" class="fa-solid fa-pen-to-square btn btn-xs btn-warning mx-2 ubahMember" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" data-id="<?= $member['id']; ?>"></a>
                                    <form action="{{ route('member.destroy', $member->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fa-solid fa-trash btn btn-xs btn-danger btn-delete" id="btn-delete"></button>
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

{{-- Start Modal Tambah --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="formModalLabel" id="exampleModalCenterTitle"></h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('member.store') }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-4">
                            <label>Kode Member</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="code_member" class="form-control" name="code_member" value="{{ 'MBR-'.$AutoNumber }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control" name="name"
                            placeholder="Nama" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="address" class="form-control" name="address"
                                placeholder="Alamat" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>No Tlp</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="number_phone" class="form-control" name="number_phone"
                                placeholder="No Tlp" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    <button type="button" class="btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Tambah --}}

<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script>
$(function () {
    $(".tambahMember").on("click", function () {
        $(".formModalLabel").html("Tambah Data Member");
        $(".modal-footer button[type=submit]").html("Tambah Data");
    });

    $(".ubahMember").on("click", function () {
        $(".formModalLabel").html("Ubah Data Member");
        $(".modal-footer button[type=submit]").html("Ubah Data");
        $(".modal-body form").attr("action", "{{ route('member.update', $member->id) }}");

        var id = $(this).data('id');
        var url = '{{ route("member.edit", ":id") }}';
        url = url.replace(":id", id);
        $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
            success: function (data) {
                $('#code_member').val(data.code_member);
                $('#name').val(data.name);
                $('#address').val(data.address);
                $('#number_phone').val(data.number_phone);
                $('#id').val(data.id);
            },
        });
    });
});
</script>
@endsection