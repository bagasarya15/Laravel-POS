@extends('layouts.main')

@section('menu-heading')
    Dashboard
@endsection

@section('title')
    Informasi Update
@endsection

@section('content')
    <section id="multiple-column-form" for="system-info.index">
        @include('layouts.sweet-alert')
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <a href="" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"> Tambah Data</a>
                            
                            <form action="{{ route('system-info.index') }}" method="GET" class="row d-flex justify-content-end">
                                <div class="col-md-4">
                                <label for="search" class="visually-hidden">Password</label>
                                    <input type="search" class="form-control" placeholder="Cari Deskripsi Update..." name="search" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Cari</button>
                                </div>
                            </form>

                            <ul class="list-group">
                            @php $i = 0; @endphp
                            @foreach ($systemUpdate as $data)
                                <div class="list-group my-1">
                                    <a href="{{ route('system-info.show', $data->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="badges">
                                            <small class="card-link">
                                            <span class="badge rounded-pill bg-warning">{{ $i++ + $systemUpdate->firstItem() }}</span>
                                        </small>
                                            <span class="badge rounded-pill bg-{{ ($data->category->name == 'Front-End') ? 'primary' : (($data->category->name == 'Backend') ? 'secondary' : 'info') }}">{{ $data->category->name }}</span>
                                        </div>
                                        <small class="card-link">
                                            <form action="{{ route('system-info.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <small type="submit" class="badge bg-danger btn-delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </small>
                                            </form>
                                        </small>

                                    </div>
                                    <p class="my-1 ms-2">
                                        {{ $data->desc }}
                                    </p>
                                    <small class="card-link ms-2 text-secondary">{{ $data->created_at->diffForHumans() }}</small>
                                    </a>
                                </div>
                            @endforeach
                            </ul>
                
                            <div class="footer">
                                <small class="text-primary">
                                    Menampilkan
                                    {{ $systemUpdate->firstItem() }}
                                    -
                                    {{ $systemUpdate->lastItem() }}
                                    baris dari
                                    {{ $systemUpdate->total() }}
                                    data
                                </small>
                                <div class="d-flex justify-content-end">
                                    {{ $systemUpdate->links() }}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
