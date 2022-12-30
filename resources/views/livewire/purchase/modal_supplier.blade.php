<div class="modal fade" id="exampleModalSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 130%">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-multiple table-hover">
                            <thead>
                                <tr class="small">
                                    <th>#</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>No Tlp</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplier as $supplier )
                                <tr class="small">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->address}}</td>
                                    <td>{{ $supplier->number_phone}}</td>
                                    <td>{{ $supplier->desc }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('purchase.add-supplier') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="supplier_id" value="{{ $supplier->id  }}" >
                                                <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>