<div class="row">
    @include('layouts.sweet-alert')
    <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary small">Total Produk Dibeli</span>
            <span class="badge bg-primary rounded-pill">{{ number_format($purchase->sum('qty')) }}</span>
        </h4>
        <form wire:submit.prevent="checkout">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Nomer Order</h6>
                        <small class="text-muted">{{ $purchase_order }}</small>
                        <small class="text-muted"><input type="hidden" class="form-control" wire:model="purchase_order" readonly></small>
                    </div>
                    
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Supplier<span class="text-danger"></span></h6>
                        @foreach ($supplier_purchase as $data)
                            <small> <span class="text-primary">{{ $data->getSupplier->name}}</span> - <span class="text-primary">{{ $data->getSupplier->desc}}</span> </small>

                            <div class="mt-1">
                                <a class="fa-solid fa-trash btn btn-sm btn-danger" wire:click="deleteSupplier">
                                </a>
                            </div>
                        @endforeach
                        
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Total Pembelian</h6>
                        <small class="text-muted">Rp {{ number_format($purchase->sum('total')) }}</small>
                    </div>
                    
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Discount</h6>
                        <input type="number" class="form-control "wire:model.lazy="discount">
                    </div>
                    
                </li>
                
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Total Harus Dibayar</h6>
                        <small class="text-muted">Rp {{ number_format((int)$purchase->sum('total') - (int)$discount) }}</small>
                    </div>
                    
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Total Bayar <span class="text-danger small"> *</span></h6>
                        <small class="text-muted">
                            <input type="number" class="form-control @error('payment') is-invalid  @enderror" wire:model.lazy="payment">
                    
                            @error('payment')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </small>
                    </div>
                </li>
            </ul>

            <div class="card">
                <div class="input-group">
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm" wire:click="checkout">
                            <i class="fa-solid fa-location-arrow"></i> Bayar
                        </button>
                    </div>
                    
                    <div wire:igrone>
                        <a class="btn btn-danger btn-sm mx-2" wire:click="nullCart">
                            <i class="fa-solid fa-trash btn-delete"></i> Kosongkan Keranjang
                        </a>
                    </div>
                </div>
                <small class="mt-2 text-danger fst-italic">* Keterangan Wajib Diisi</small>
            </div>
        </form>
    </div>

    <div class="col-md-7 col-lg-8">
        <div class="d-flex">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-magnifying-glass"></i> Cari Produk
            </button>
            <button type="button" class="btn btn-info btn-sm mb-2 ms-1" data-bs-toggle="modal" data-bs-target="#exampleModalSupplier">
                <i class="fa-solid fa-magnifying-glass"></i> Cari Supplier
            </button>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="small text-center">
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Jumlah Dibeli</th>
                            <th>Harga / Pcs</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="small">
                        @foreach ($purchase as $purchase)
                            <tr class="small text-center">
                                <td> {{ $purchase->products->name }} </td>
                                <td>
                                    <div>
                                        <input type="number" class="form-control w-100 d-inline-flex" wire:model.defer="update_qty">
                                    </div>
                                </td>
                                <td>{{ $purchase->qty }} </td>
                                <td>Rp. {{ number_format($purchase->products->price_buy) }} </td>
                                <td>Rp. {{ number_format($purchase->total) }} </td>
                                <td class="d-flex">
                                    <div class="me-1">
                                        <a class="btn btn-warning btn-sm" wire:click="updateQty({{$purchase->id}})">Update</i></a>
                                    </div>
                                    <div wire:igrone>
                                        <button type="submit" class="btn btn-danger btn-sm" wire:click.prevent='deleteConfirmation({{ $purchase->id }})'><i class="fa fa-trash"></i></button>
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

{{-- Start Modal --}}
@include('livewire.purchase.modal_product')
@include('livewire.purchase.modal_supplier')
{{-- End Modal --}}

@push('script')
    <script> 
        $(document).ready(function () {
            $('.table-multiple').DataTable();

            // $('#select2-supplier').select2();
            // $('#select2-supplier').on('change', function (e) {
            //     @this.set('supplier_id', e.target.value);
            // });
            
            //Swall Delete Confirmation
            window.addEventListener('delete-confirm', event => {
                Swal.fire({
                    title: "Konfirmasi Hapus !",
                    text: "Yakin ingin menghapus data ini ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus !",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emit('deleteConfirmed');
                    }
                })
            });
        });
    </script>
@endpush