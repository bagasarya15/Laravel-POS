<div class="row">
    @include('layouts.sweet-alert')
    <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary small">Total Produk Dibeli</span>
            <span class="badge bg-primary rounded-pill">{{ number_format($transaction->sum('qty')) }}</span>
        </h4>
        <form wire:submit.prevent="checkout">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">

                    <div>
                        <h6 class="my-0">Nomer Order <span class="text-danger small"> *</span></h6>
                        <small class="text-muted">
                            <input type="text" class="w-100 form-control @error('no_order') is-invalid  @enderror" wire:model="no_order" readonly>
                            @error('no_order')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Customer <span class="text-danger"></span></h6>
                        @foreach ($orderMember as $orderMember)
                            <small> <span class="text-primary">{{ $orderMember->getMember->code_member}}</span> - <span class="text-primary">{{ $orderMember->getMember->name}}</span> </small>
                            
                            <div class="mt-1">
                                <span class="badge rounded-pill bg-{{ $orderMember->getMember->member_status == 'Non-Member' ? 'warning' : 'secondary' }}">{{ $orderMember->getMember->member_status }}</span>
                                <a class="fa-solid fa-trash btn btn-sm btn-danger" wire:click="deleteMember">
                                </a>
                            </div>
                        @endforeach
                        
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Total Pembelian</h6>

                        <small class="text-muted">Rp {{ number_format($transaction->sum('total')) }}</small>
                    </div>
                    
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    {{-- Discount --}}
                    @php
                        $price             = $transaction->sum('total');

                        // Discount 3% 
                            $discount1       = 3 ;
                            $totalDiscount1  = ($discount1 / 100) * $price ;
                            $totalPrice1     = $price - $totalDiscount1 ; 
                        // End

                        // Discount 5% 
                            $discount2         = 5 ;
                            $totalDiscount2    = ($discount2 / 100) * $price ;
                            $totalPrice2     = $price - $totalDiscount2 ; 
                        // End

                        // Discount 10%
                            $discount3         = 10 ;
                            $totalDiscount3    = ($discount3 / 100) * $price ;
                            $totalPrice3     = $price - $totalDiscount3 ; 
                        // End
                    @endphp
                    {{-- /End --}}

                    <div id="parentDiscount">
                        <h6 class="my-0">Diskon <span class="text-danger small"> *</span></h6>
                        <div>                
                            <select class="form-select @error('discount') is-invalid  @enderror discountSelect">
                                <option selected value="">Pilih Diskon</option>
                                <option value="{{ $price - $price }}">Non-Member 0%</option>
                                <option value="{{ $price - $totalPrice1 }}">Discount 3%</option>
                                <option value="{{ $price - $totalPrice2 }}">Discount 5%</option>
                                <option value="{{ $price - $totalPrice3 }}">Discount 10%</option>
                            </select>

                            @error('discount')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total Harus Dibayar</span>
                    <strong>Rp {{ number_format( (int)$price - (int)$discount ) }}</strong>
                </li>
                
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Total Bayar <span class="text-danger small"> *</span></h6>
                        <small class="text-muted">
                            <input type="number" class="form-control @error('payment') is-invalid  @enderror" wire:model="payment">
                    
                            @error('payment')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span> Kembalian</span>
                    <strong>Rp  {{ number_format( (int)$payment - (int)$price + (int)$discount) }}</strong>
                </li>

            </ul>

            <div class="card">
                <div class="input-group d-flex">
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm btn-blank">
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

            <button type="button" class="btn btn-info btn-sm mb-2 ms-1" data-bs-toggle="modal" data-bs-target="#exampleModalMember">
                <i class="fa-solid fa-magnifying-glass"></i> Cari Customer
            </button>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-center small">
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="text-center small">
                            @foreach ($transaction as $transaction)
                            <tr class="text-center small">
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $transaction->products->name }} </td>
                                <td>
                                    <div class="d-inline-flex">
                                        @if ($transaction->qty > 1)
                                            <button class="btn btn-danger btn-sm ms-1" wire:click="minQty({{$transaction->id}})"><i class="fa fa-minus"></i></button>
                                        @endif
                                        
                                        @if ($transaction->qty >= $transaction->products->stok )
                                            <small class="text-danger ms-2 mt-2">stok tidak tersedia </small>
                                        @else
                                            <input type="text" class="form-control mx-1 w-50 " value="{{ $transaction->qty }}" readonly>
                                            <button class="btn btn-primary btn-sm" wire:click="plusQty({{$transaction->id}})"><i class="fa fa-plus"></i></button>
                                        @endif
                                    </div>
                                </td>
                                <td>Rp. {{ number_format($transaction->products->price_sell)}} </td>
                                <td>Rp. {{ number_format($transaction->products->price_sell * $transaction->qty)}} </td>
                                <td>
                                    <div wire:igrone>
                                        <button type="submit" class="btn btn-danger btn-sm" wire:click.prevent='deleteConfirmation({{ $transaction->id }})'><i class="fa fa-trash"></i></button>
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

<!-- Modal Add Cart & Member -->
@include('livewire.transaction.modal_product')
@include('livewire.transaction.modal_member')
<!-- End Modal  -->

@push('script')
    <script>
        $(document).ready(function () {
            $('.table-multiple').DataTable();
            
            $('.discountSelect').on('change', function(){
                @this.discount = $(this).val()
            });

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
