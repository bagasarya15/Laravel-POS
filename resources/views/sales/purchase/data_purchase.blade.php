@extends('layouts.main')

@section('menu-heading')
    Transaksi
@endsection

@section('title')
    Data Pembelian
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#dataOrder">Data Pembelian</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#dataOrderProduk" tabindex="-1">Data Order Produk</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('purchase.index') }}">Transaksi Pembelian</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="dataOrder">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-multiple table-hover">
                                <thead style="font-size: 13px">
                                    <tr>
                                        <th>No</th>
                                        <th>Purchase Invoice</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Dibeli Oleh</th>
                                        <th>Supplier</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Dibayar</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px">
                                    @php
                                        $i = 1;    
                                    @endphp
                                    @foreach ($purchase as $order)
                                    <tr>
                                        <td> {{  $i++ }}</td>
                                        <td><a href="{{ route('purchase.invoice', $order->purchase_order ) }}" class="text-primary">{{ $order->purchase_order }}</a></td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->purchase_by }}</td>
                                        <td>{{ $order->getSupplier->name }}</td>                                  
                                        <td>Rp {{ number_format($order->discount) }}</td>
                                        <td>Rp {{ number_format($order->total) }}</td>
                                        <td>Rp {{ number_format($order->payment) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="dataOrderProduk">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-multiple table-hover">
                                <thead style="font-size: 13px">
                                    <tr>
                                        <th>No</th>
                                        <th>Purchase Invoice</th>
                                        <th>Produk</th>
                                        <th>Jumlah Beli</th>
                                        <th>Harga / Pcs</th>
                                        <th>Total Pembelian</th>
                                        <th>Tanggal Pembelian</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px">
                                    @php
                                        $j = 1;    
                                    @endphp
                                    @foreach ($purchaseProduct as $data)
                                    <tr>
                                        <td> {{  $j++ }}</td>
                                        <td><a href="{{ route('purchase.invoice', $data->getOrder->purchase_order) }}" class="text-primary">{{ $data->getOrder->purchase_order }}</a></td>
                                        <td>{{ $data->getProduct->name }}</td>
                                        <td>{{ $data->qty }}</td>
                                        <td>Rp {{ number_format($data->getProduct->price_sell )}}</td>
                                        <td>Rp {{ number_format($data->total) }}</td>
                                        <td>{{ $data->getOrder->created_at }}</td>
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

    @push('script')
        <script>
            $(document).ready( function () {
                $('.table-multiple').DataTable();
            } );
        </script>   
    @endpush
@endsection
