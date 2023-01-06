<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 130%">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-multiple table-hover">
                            <thead>
                                <tr class="small">
                                    <th>#</th>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Image</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product )
                                <tr class="small">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge bg-primary text-light">{{ $product->code_product }}</span></td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp {{ number_format($product->price_sell) }}</td>
                                    <td>
                                        {{ $product->stok }}
                                    </td>
                                    <td><img class="rounded-circle" width="45px" src="{{ asset('storage/'.$product ->image) }}" alt="Foto Produk"></td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('transaction.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" >
                                                <input type="hidden" name="qty" value="1" >
                                                <input type="hidden" name="total" value="{{ $product->price_sell }}" >
                                                <input type="hidden" name="add_by" value="{{ auth()->user()->id }}">
                                                @if ($product->stok == 0)
                                                    <span class="text-danger">{{ 'Stok Habis' }}</span>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i></button>
                                                @endif
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