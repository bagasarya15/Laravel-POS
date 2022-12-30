<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $purchase->purchase_order }}</title>

@include('helper.report_css')
<body class="hold-transition sidebar-mini" onload="window.print()">
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <div class="invoice p-3 mb-3">
                            <div class="row invoice-info">
                                <div class="col-md-5 invoice-col">
                                    <th>No Order <span style="margin-left:72px">:</span> </th> {{ $purchase->purchase_order }}<br>
                                    <th>Dibeli Oleh<span style="margin-left:64px">:</span> </th> {{ $purchase->purchase_by }}<br>
                                    <th>Supplier <span style="margin-left:80px">:</span> </th> {{ $purchase->getSupplier->name }}<br>
                                    <th>Tanggal Pembelian <span style="margin-left:5px">:</span> </th>  {{ $purchase->created_at }}<br>
                                </div>
                            </div>
                            
                        <div class="row mt-4">
                            <div class="col-lg-12 table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="small">
                                            <th>No</th>
                                            <th>Kode Produk</th>
                                            <th>Produk</th>
                                            <th>Jumlah Beli</th>
                                            <th>Harga Beli / Pcs</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchase->productOrder as $data)
                                            <tr class="small">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->getProduct->code_product }}</td>
                                                <td>{{ $data->getProduct->name }}</td>
                                                <td>{{ $data->qty }}</td>
                                                <td>Rp {{ number_format($data->getProduct->price_buy) }}</td>
                                                <td>Rp {{ number_format($data->total) }}</td>
                                            </tr>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-3 mt-3">
                            <div class="table-responsive">
                                @php
                                    $subtotal = $purchase->total ;
                                    $discount = $purchase->discount ;
                                    $total    = $subtotal - $discount ;
                                @endphp
                                <table class="table">
                                    <tr class="small">
                                        <th>Subtotal</th>
                                        <td>Rp {{ number_format($purchase->total) }}</td>
                                    </tr>
                                    <tr class="small">
                                        <th>Discount</th>
                                        <td>Rp {{ number_format($purchase->discount) }}</td>
                                    </tr>
                                    <tr class="small">
                                        <th>Dibayar</th>
                                        <td>Rp {{ number_format($purchase->payment) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
</div>
@include('helper.report_script')
</body>
</html>
