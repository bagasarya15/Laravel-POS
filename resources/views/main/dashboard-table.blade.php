<div class="row ms-1">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#riwayatTransaksi">Riwayat Transaksi</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#riwayatPembelian" tabindex="-1">Riwayat Pembelian</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="riwayatTransaksi">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Riwayat Transaksi Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table dataTable1 table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Invoice</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Customer</th>
                                                <th>Subtotal</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                <th>Dibayar</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 13px">
                                            @php
                                                $i = 1;    
                                            @endphp
                                            @foreach ($order as $order)
                                            <tr>
                                                <td> {{  $i++ }}</td>
                                                <td><a href="{{ route('transaction.invoice', $order->no_order) }}" target="__blank" class="text-primary">{{ $order->no_order }}</a></td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->member->name }}</td>
                                                <td>Rp {{ number_format($order->sub_total) }}</td>
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
                    </div>
                </div>
                <div class="tab-pane fade" id="riwayatPembelian">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Riwayat Pembelian Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table dataTable1 table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Order</th>
                                                <th>Tanggal Pembelian</th>
                                                <th>Dibeli Oleh</th>
                                                <th>Supplier</th>
                                                <th>Total Pembelian</th>
                                                <th>Dibayar</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 13px">
                                            @php
                                                $i = 1;    
                                            @endphp
                                            @foreach ($purchaseOrder as $data)
                                            <tr>
                                                <td> {{  $i++ }}</td>
                                                <td><a href="{{ route('purchase.invoice', $data->purchase_order) }}" target="__blank" class="text-primary">{{ $data->purchase_order }}</a></td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>{{ $data->purchase_by }}</td>
                                                <td>{{ $data->getSupplier->name}}</td>
                                                <td>Rp {{ number_format($data->total) }}</td>
                                                <td>Rp {{ number_format($data->payment )}}</td>
                                                
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
        </div>
    </div>
</div>