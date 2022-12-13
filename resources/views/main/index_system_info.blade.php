@extends('layouts.main')

@section('menu-heading')
    Dashboard
@endsection

@section('title')
    Informasi Update
@endsection

@section('content')
    @include('layouts.sweet-alert')
    <div class="card">
        <div class="card-body table-responsive">
            <a href="" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"> Tambah Data</a>
            <table class="table dataTable1 table-striped">
                <thead style="font-size: 13px;">
                    <tr>
                        <th>#</th>
                        <th>Update For</th>
                        <th>Tanggal Comit</th>
                        <th>Keterangan Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px">
                    @foreach ($data as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <span class="badge rounded-pill bg-{{ ($data->category->name == 'Front-End') ? 'primary' : (($data->category->name == 'Backend') ? 'secondary' : 'info') }}">{{ $data->category->name }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}</td>
                        <td>{{ $data->desc }}</td>
                        
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('system-info.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a type="submit" class="badge bg-danger btn-delete text-light">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </form>
                                <a href="{{ route('system-info.show', $data->id) }}" class="badge bg-warning ms-2">
                                    <i class="fa-solid fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <section for="modal-system-update">
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <form action="{{ route('system-info.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                <div class="col-md-4">
                                    <label>Update For</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select name="category_id" id="category_id" class="form-select" id="basicSelect">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Keterangan Update</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea class="form-control" id="desc" name="desc" placeholder="Keterangan Update" rows="3"></textarea required>
                                </div>
                                <div class="col-md-4">
                                    <label>Tanggal Update</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="datetime-local" value="{{ Carbon\Carbon::now() }}" id="created_at" class="form-control" name="created_at" required>
                                    <input type="hidden" value="{{ Carbon\Carbon::now() }}" id="updated_at" class="form-control" name="updated_at" required>
                                </div>
                            </div>
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
